<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutFormRequest;
use App\Mail\ThemeMail;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderUpdate;
use App\Models\ProductVariationStock;
use App\Models\Province;
use App\Models\Voucher;
use App\Models\VoucherType;
use App\Models\VoucherUsage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{

    public $hash_secret, $tmncode;
    public function __construct()
    {
        // có thể lên https://sandbox.vnpayment.vn/devreg/ để đăng ký sanbox
        $this->hash_secret = 'TSUHRVGRSQRFWCCTVNUUJBENWNHVTRBB';
        $this->tmncode = '1J7H9XAA';
    }
    public function index()
    {
        $addresses = Address::where('user_id', auth()->user()->id)->get();
        $provinces = Province::orderBy('name')->get();
        $carts = Cart::where('user_id', auth()->user()->id)->get();
        if (count($carts) > 0) {
            checkCouponValidityForCheckout($carts);
        } else {
            return redirect()->route('home')->with(noti('Vui lòng thêm sản phẩm vào giỏ hàng', 'error'));;
        }
        return view('clients.checkout.index', compact('addresses', 'carts', 'provinces'));
    }
    public function complete(CheckoutFormRequest $request)
    {
        $user = auth()->user();
        $userId = $user->id;
        $carts  = Cart::where('user_id', $userId)->get();

        try {

            // DB::beginTransaction();
            if (count($carts) > 0) {
                $validationResult = $this->validateAddress($request);
                if ($validationResult !== true) {
                    return redirect()->back()->with(noti($validationResult, 'error'));
                }
                $existingAddress = Address::where('user_id', $userId)
                    ->where('name', $request->name)
                    ->where('phone', $request->phone)
                    ->where('province_id', $request->province_id)
                    ->where('district_id', $request->district_id)
                    ->where('ward_id', $request->ward_id)
                    ->where('village_id', $request->village_id)
                    ->where('address', $request->address)
                    ->first();

                if (!$existingAddress) {
                    $address                = new Address;
                    $address->user_id       = $userId;
                    $address->name       = $request->name;
                    $address->phone       = $request->phone;
                    $address->province_id    = $request->province_id;
                    $address->district_id      = $request->district_id;
                    $address->ward_id       = $request->ward_id;
                    $address->village_id       = $request->village_id;
                    $address->address       = $request->address;
                    $address->is_default    = 0;
                    $address->save();
                    $addressId = $address->id;
                } else {
                    $addressId = $request->address_wallet;
                    if ($addressId) {
                        $checkAddress = Address::where('id', $addressId)
                            ->where('user_id', $userId)
                            ->first();
                        if (!$checkAddress) {
                            $noti = ['message' => 'Vui lòng chọn địa chỉ đã lưu chính xác', 'alert-type' => 'error'];
                            return redirect()->back()->with($noti);
                        }
                    }
                }


                $couponResponse = checkCouponValidityForCheckout($carts);
                if ($couponResponse['status'] == false) {
                    $noti = ['message' => $couponResponse['message'], 'alert-type' => 'error'];
                    return redirect()->back()->with($noti);
                }

                # kiểm tra số lượng hàng trong giỏ hàng
                foreach ($carts as $cart) {
                    $variation = $cart->product_variation;
                    $product = $variation ? $variation->product : null; // Lấy thông tin sản phẩm

                    if (!$product) {
                        continue; // Bỏ qua nếu không có sản phẩm
                    }

                    // Lấy thông tin các thuộc tính của biến thể
                    $variationOptions = '';
                    if (generateVariationOptions($variation->combinations)) {
                        $options = [];
                        foreach (generateVariationOptions($variation->combinations) as $option) {
                            $optionValues = implode(', ', array_column($option['values'], 'name')); // Nối các giá trị bằng dấu phẩy
                            $options[] = $option['name'] . ': ' . $optionValues;
                        }
                        $variationOptions = implode(' | ', $options); // Nối các thuộc tính bằng dấu gạch đứng
                    }

                    // Kiểm tra số lượng trong kho
                    if ($product->has_variation) {
                        // Sản phẩm có biến thể
                        if ($variation->product_variation_stock->stock_qty < $cart->quantity) {
                            $productName = $product->name;
                            $availableStock = $variation->product_variation_stock->stock_qty;
                            $message = 'Sản phẩm "' . $productName . '" (' . $variationOptions . ') hiện chỉ còn ' . $availableStock . ' sản phẩm trong kho. Vui lòng điều chỉnh lại số lượng phù hợp.';
                            $noti = ['message' => $message, 'alert-type' => 'error'];
                            return redirect()->route('cart')->with($noti);
                        }
                    } else {
                        // Sản phẩm không có biến thể
                        if ($product->stock_qty < $cart->quantity) {
                            $productName = $product->name;
                            $availableStock = $product->stock_qty;
                            $message = 'Sản phẩm "' . $productName . '" hiện chỉ còn ' . $availableStock . ' sản phẩm trong kho. Vui lòng điều chỉnh lại số lượng phù hợp.';
                            $noti = ['message' => $message, 'alert-type' => 'error'];
                            return redirect()->route('cart')->with($noti);
                        }
                    }
                }

                # kiểm tra mã giảm giá
                $voucher = null;
                $voucherType = null;
                if (getCoupon() != '') {
                    $checkCoupon = checkCouponValidityForCheckout($carts);
                    if ($checkCoupon['status']) {
                        $voucherType = VoucherType::where('name', getCoupon())->first();
                        if ($voucherType) {
                            $voucher = Voucher::where('voucher_type_id', $voucherType->id)->first();
                        }
                    }
                }

                if ($request->payment_method == 'VNPAY') {
                    $payment_method = "VNPAY";
                } else {
                    $payment_method = "COD";
                }

                # lưu dữ liệu order
                $order                                     = new Order;
                $order->user_id                            = $userId;
                $order->order_date                         =  now();
                $order->coupon_id                          = isset($voucher) ? $voucher->id : NULL;
                $order->order_status                       = "PENDING";
                $order->shipment_status                    = "ORDERPLACE";
                $order->payment_method                     = $payment_method;
                $order->payment_id                         = NULL;
                $order->address_id                         = $addressId;
                $order->note                               = $request->note ?? null;
                $order->coupon_discount_amount             = $voucherType->discount ?? 0;
                if (getCoupon() != '') {
                    $order->total_amount  = getCouponDiscount(getSubTotal($carts, false), getCoupon());
                } else {
                    $order->total_amount      = getSubTotal($carts, false);
                }
                $order->save();


                # lưu dữ liệu OrderDetail
                foreach ($carts as $cart) {
                    $variation = $cart->product_variation;
                    $product = $variation ? $variation->product : null;

                    if (!$product) {
                        continue;
                    }
                    $orderItem = new OrderDetail();
                    $orderItem->quantity = $cart->quantity;
                    $orderItem->order_id = $order->id;
                    $orderItem->product_variation_id = $variation->id;
                    $orderItem->save();

                    // Trừ số lượng
                    if ($product->has_variation) {
                        // Sản phẩm có biến thể
                        $productVariationStock = ProductVariationStock::where('id', $variation->id)->first();

                        if ($productVariationStock) {
                            $productVariationStock->stock_qty = max(0, $productVariationStock->stock_qty - $orderItem->quantity); // Đặt giá trị bằng 0 nếu trừ ra âm
                            $productVariationStock->save();
                        }
                    } else {
                        // Sản phẩm không có biến thể
                        $product->stock_qty = max(0, $product->stock_qty - $orderItem->quantity); // Đặt giá trị bằng 0 nếu trừ ra âm
                        $product->save();
                    }
                    // Xoá cart
                    $cart->delete();
                }



                # giảm số lần sử dụng voucher
                if (getCoupon() != '') {
                    $voucher->voucher_quantity -= 1;
                    $voucher->save();

                    // lịch sử sử dụng
                    $couponUsageByUser = VoucherUsage::where('user_id', auth()->user()->id)
                        ->where('name', $voucherType->name)->first();
                    if (!is_null($couponUsageByUser)) {
                        $couponUsageByUser->usage_count += 1;
                    } else {
                        $couponUsageByUser = new VoucherUsage;
                        $couponUsageByUser->usage_count = 1;
                        $couponUsageByUser->name = getCoupon();
                        $couponUsageByUser->user_id = $userId;
                    }
                    $couponUsageByUser->save();
                    removeCoupon();
                }

                #thanh toán
                if ($request->payment_method == "VNPAY") {
                    $response = $this->createLinkPayment($order->total_amount); // tạo và chuyển hướng đến trang VNPAY
                    if ($response['code'] == 00 && $response['orderCode']) {
                        $data = [
                            'total_amount' => $order->total_amount,
                            'user_id' => auth()->user()->id,
                            'order_date' => now(),
                            'order_status' => 'PENDING',
                            'shipment_status' => 'ORDERPLACE',
                            'payment_method' => 'VNPAY',
                            'payment_id' => $response['orderCode'],
                        ];
                        $orderUpdate = Order::where('id', $order->id)->update($data);
                        if ($orderUpdate) {
                            return redirect()->to($response["data"]);
                        } else {
                            $notification = array('message' => 'Lỗi quá trình xử lý.', 'alert-type' => 'error');
                            return redirect()->back()->with($notification);
                        }
                    } else {
                        $notification = array('message' => 'Xử lý VNPAY thất bại.', 'alert-type' => 'error');
                        return redirect()->back()->with($notification);
                    }
                } else {
                    $data = [
                        'total_amount' => $order->total_amount,
                        'user_id' => auth()->user()->id,
                        'order_date' => now(),
                        'order_status' => 'PENDING',
                        'shipment_status' => 'ORDERPLACE',
                        'payment_method' => 'COD',
                        'payment_id' => NULL,
                    ];
                    $orderUpdate = Order::where('id', $order->id)->update($data);
                }

                $notification = array('message' => 'Xử lý thành công.', 'alert-type' => 'success');
                return redirect()->route('checkout.invoice', $order->id)->with($notification);
            }
        } catch (\Throwable $th) {
            Log::info('Thanh toán có lỗi:' . $th->getMessage());
            DB::rollBack();
            dd($th);
            $notification = array('message' => $th->getMessage(), 'alert-type' => 'error');
            return redirect()->route('home')->with($notification);
        }

        $notification = array('message' => 'Giỏ hàng trống.', 'alert-type' => 'error');
        return redirect()->back()->with($notification);
    }
    private function validateAddress(Request $request)
    {
        // Lấy tỉnh
        $province = Province::where('code', $request->province_id)->first();
        if (!$province) {
            return 'Tỉnh không hợp lệ';
        }

        // Lấy huyện
        $district = $province->districts()->where('code', $request->district_id)->first();
        if (!$district) {
            return 'Huyện không hợp lệ';
        }

        // Lấy xã
        $ward = $district->wards()->where('code', $request->ward_id)->first();
        if (!$ward) {
            return 'Xã không hợp lệ';
        }

        // Lấy thôn
        $village = $ward->villages()->where('code', $request->village_id)->first();
        if (!$village) {
            return 'Thôn không hợp lệ';
        }

        return true; // Tất cả đều hợp lệ
    }
    #tạo và chuyển hướng VNPAY
    public function createLinkPayment($amount)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('checkout.checkPayVNPAY'); //callback
        $vnp_TmnCode = $this->tmncode;
        $vnp_HashSecret = $this->hash_secret;
        $id = auth()->user()->id;
        $vnp_TxnRef = $id . intval(substr(strval(microtime(true) * 10000), -6));
        $user = auth()->user();
        $vnp_OrderInfo = "$user->name thanh toán đơn hàng";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $amount  * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = '';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        if (isset($_POST['redirect'])) {
            return redirect($vnp_Url);
        } else {
            session()->put('vnpay_orderCode', $vnp_TxnRef);
            return ['code' => '00', 'message' => 'success', 'data' => $vnp_Url, 'orderCode' => $vnp_TxnRef];
        }
    }

    #callback VNPAY
    public function checkPayVNPAY(Request $request)
    {
        $orderCode = session()->get('vnpay_orderCode');
        $order = Order::where('payment_id', $orderCode)->first();
        $getInfoPayment = $this->getPaymentLinkInformation($orderCode); // Kiểm tra trạng thái thanh toán từ VNPAY
        if ($order && $getInfoPayment->RspCode == 00 && $getInfoPayment) {
            if ($getInfoPayment->status != $order->order_status) {
                $data = [
                    'order_status' => $getInfoPayment->status,
                    'shipment_status' => $getInfoPayment->status == "PAID" ? 'PACKED' : 'ORDERPLACE',
                ];
                $update = Order::where('id', $order->id)->where('user_id', auth()->user()->id)->update($data);
                if ($update) {
                    // Gửi mail cho khách, nhân viên biết,...
                    if (Session::has('vnpay_orderCode')) {
                        Session::forget('vnpay_orderCode');
                    }
                    if ($getInfoPayment->status == "PAID") {
                        $status = 'Đã thanh toán';
                    }
                    OrderUpdate::create([
                        'order_id' => $order->id,
                        'user_id' => auth()->user()->id,
                        'note' => 'Trạng thái thanh toán được cập nhật thành ' . $status . '.',
                    ]);
                    OrderUpdate::create([
                        'order_id' => $order->id,
                        'user_id' => auth()->user()->id,
                        'note' => 'Đơn hàng đã nhận và đang đóng gói',
                    ]);
                    $dataMail =[
                        'name' => auth()->user()->name ?? NULL,
                        'email' => auth()->user()->email ?? NULL,
                        'url_invoice' => '',
                        'id_invoice' => $order->id,
                        'created_at_invoice' => Carbon::parse($order->created_at)->format('d-m-Y H:i'),
                        'payment_method_invoice' => $order->payment_method,
                        'order_status_invoice' => getStatusOrder($order->order_status),
                        'price_invoice' => format_cash($order->total_amount)
                    ];
                    Mail::to(auth()->user()->email)
                    ->send((new ThemeMail($dataMail, 'invoice'))->subject('Hoá đơn #'.$order->id.' tại ' . env('APP_NAME')));
                    $notification = array('message' => 'Xử lý thành công.', 'alert-type' => 'success');
                    // return redirect()->route('checkout.invoice', $order->id)->with($notification);
                } else {
                    $notification = array('message' => 'Lỗi quá trình xử lý.', 'alert-type' => 'error');
                    return redirect()->back()->with($notification);
                }
            }
        } else {
            $notification = array('message' => 'Lỗi quá trình xử lý hoá đơn.', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }

    #check VNPAY
    public function getPaymentLinkInformation($orderCode)
    {
        $inputData = array();
        $returnData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $this->hash_secret);
        $vnpTranId = $inputData['vnp_TransactionNo'];
        $vnp_BankCode = $inputData['vnp_BankCode'];
        $vnp_Amount = $inputData['vnp_Amount'] / 100; // Số tiền thanh toán VNPAY phản hồi
        $Status = 0;
        $orderId = $inputData['vnp_TxnRef'];

        try {
            //Check Orderid
            if ($orderCode == $inputData['vnp_TxnRef']) {
                //Kiểm tra checksum của dữ liệu
                if ($secureHash == $vnp_SecureHash) {
                    if ($inputData['vnp_ResponseCode'] == '00' || $inputData['vnp_TransactionStatus'] == '00') {
                        $Status = 1; // Trạng thái thanh toán thành công
                        $returnData['status'] = 'PAID';
                    } else {
                        $Status = 2; // Trạng thái thanh toán thất bại / lỗi
                        $returnData['status'] = 'CANCELED';
                    }
                    $returnData['RspCode'] = '00';
                    $returnData['Message'] = 'Confirm Success';
                } else {
                    $returnData['RspCode'] = '97';
                    $returnData['Message'] = 'Invalid signature';
                    $returnData['status'] = 'UNKNOW';
                }
            } else {
                $returnData['RspCode'] = '99';
                $returnData['Message'] = 'Unknow error';
                $returnData['status'] = 'UNKNOW';
            }
        } catch (\Exception $e) {
            $returnData['RspCode'] = '99';
            $returnData['Message'] = 'Unknow error';
            $returnData['status'] = 'UNKNOW';
        }
        return response()->json($returnData)->getData();
    }
}
