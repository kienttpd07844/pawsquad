<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\ProductVariation;
use App\Models\ProductVariationStock;
use App\Models\Voucher;
use App\Models\VoucherType;
use App\Models\VoucherUsage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index()
    {
        $carts = null;
        if (Auth::check()) {
            $carts          = Cart::where('user_id', Auth::user()->id)->get();
        } else {
            $carts          = Cart::where('guest_user_id', (int) $_COOKIE['guest_user_id'])->get();
        }
        return view('clients.cart.index', ['carts' => $carts]);
    }
    public function add(Request $request)
    {
        $productVariation = ProductVariation::where('id', $request->product_variation_id)->first();
        if (!is_null($productVariation)) {
            $cart = null;
            $message = '';

            if (Auth::check()) {
                $cart          = Cart::where('user_id', Auth::user()->id)->where('product_variation_id', $productVariation->id)->first();
            } else {
                $cart          = Cart::where('guest_user_id', (int) $_COOKIE['guest_user_id'])->where('product_variation_id', $productVariation->id)->first();
            }

            if (is_null($cart)) {
                $product = $productVariation->product;
                $cart = new Cart;
                $cart->product_variation_id = $productVariation->id;
                $cart->quantity                  = (int) $request->quantity;
                $cart->product_id          = $product->id;

                if (Auth::check()) {
                    $cart->user_id          = Auth::user()->id;
                } else {
                    $cart->guest_user_id    = (int) $_COOKIE['guest_user_id'];
                }
                $message =  'Đã thêm sản phẩm vào giỏ hàng';
            } else {
                $product = $cart->product_variation->product;
                if ($product->has_variation) {
                    $stock = ProductVariationStock::where('product_variation_id', $cart->product_variation->id)->first();
                    if ($stock->stock_qty > $cart->quantity) {
                        $cart->quantity                  += (int) $request->quantity;
                        $message =  'Số lượng đã được tăng lên';
                    } else {
                        $message = 'Vượt quá số lượng trong kho';
                        return $this->getCartsInfo($message, true, '', 'warning');
                    }
                } else {
                    if ($product->stock_qty > $cart->quantity) {
                        $cart->quantity                  += (int) $request->quantity;
                        $message =  'Số lượng đã được tăng lên';
                    } else {
                        $message = 'Vượt quá số lượng trong kho';
                        return $this->getCartsInfo($message, true, '', 'warning');
                    }
                }
            }
            $cart->save();
            removeCoupon();
            return $this->getCartsInfo($message, false);
        }
    }
    public function update(Request $request)
    {
        try {
            if (Auth::check()) {
                $cart  = Cart::where('user_id', Auth::user()->id)->where('id', $request->id)->first();
            } else {
                $cart  = Cart::where('guest_user_id', request()->cookie('guest_user_id'))->where('id', $request->id)->first();
            }
            if ($request->action == "increase") {
                $product = $cart->product_variation->product;
                if ($product->has_variation) {
                    $stock = ProductVariationStock::where('product_variation_id', $cart->product_variation->id)->first();
                    if ($stock->stock_qty > $cart->quantity) {
                        $cart->quantity                  += 1;
                        $cart->save();
                        $message =  'Số lượng đã được tăng lên';
                    } else {
                        $message = 'Vượt quá số lượng trong kho';
                        return $this->getCartsInfo($message, true, '', 'warning');
                    }
                } else {
                    if ($product->stock_qty > $cart->quantity) {
                        $cart->quantity                  += 1;
                        $cart->save();
                        $message =  'Số lượng đã được tăng lên';
                    } else {
                        $message = 'Vượt quá số lượng trong kho';
                        return $this->getCartsInfo($message, true, '', 'warning');
                    }
                }
            } elseif ($request->action == "decrease") {
                if ($cart->quantity > 1) {
                    $cart->quantity -= 1;
                    $cart->save();
                    $message =  'Số lượng sản phẩm đã giảm';
                }
            } else {
                $cart->delete();
                $message =  'Xoá sản phẩm thành công';
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
        removeCoupon();
        return $this->getCartsInfo('', false);
    }
    # apply coupon
    public function applyCoupon(Request $request)
    {
        $voucherType = VoucherType::where('name', $request->code)->first();
        if ($voucherType) {
            $voucher = Voucher::where('voucher_type_id', $voucherType->id)->first();
            $currentDateTime = Carbon::now()->toDateTimeString();

            # Kiểm tra xem phiếu giảm giá có hết hạn chưa
            if ($voucher->start_date <= $currentDateTime && $voucher->expired_date >= $currentDateTime) {
                $carts = null;
                if (Auth::check()) {
                    $carts  = Cart::where('user_id', Auth::user()->id)->get();
                    if ($voucher->voucher_quantity <= 0) {
                        removeCoupon();
                        return $this->couponApplyFailed('Đã hết lượt sử dụng mã giảm giá');
                    }
                    # total coupon usage

                    $totalCouponUsage = VoucherUsage::where('name', $voucherType->name)->sum('usage_count');
                    if ($totalCouponUsage >= $voucherType->customer_usage_limit) {
                        removeCoupon();
                        return $this->couponApplyFailed('Mã giảm giá đã được sử dụng');
                    }
                } else {
                    $carts  = Cart::where('guest_user_id', request()->cookie('guest_user_id'))->get();
                }


                # Chi tiêu tối thiểu
                $subTotal = (float) getSubTotal($carts, false);

                if ($subTotal >= (float) $voucherType->min_spend) {
                    setCoupon($voucherType);
                    setCouponTypeDiscount($voucherType->discount, $voucherType->discount_type);
                    return $this->getCartsInfo('Áp dụng mã giảm giá thành công', true, $voucherType->name);
                }
                # tối thiểu
                removeCoupon();
                return $this->couponApplyFailed('Hãy mua sắm ít nhất ' . format_cash($voucherType->min_spend));
            }
            # Kiểm tra nếu phiếu giảm giá chưa đến thời gian bắt đầu
            if ($voucher->start_date > $currentDateTime) {
                removeCoupon();
                return $this->couponApplyFailed('Mã giảm giá chưa đến thời gian bắt đầu');
            }

            # Kiểm tra nếu phiếu giảm giá đã hết hạn
            if ($voucher->expired_date < $currentDateTime) {
                removeCoupon();
                return $this->couponApplyFailed('Mã giảm giá đã hết hạn');
            }

            # hết hạn
            removeCoupon();
            return $this->couponApplyFailed('Mã giảm giá đã hết hạn');
        }

        // không tồn tại
        removeCoupon();
        return $this->couponApplyFailed('Mã giảm giá không tồn tại');
    }

    # thất bại
    private function couponApplyFailed($message = '', $success = false)
    {
        $response = $this->getCartsInfo($message, false);
        $response['success'] = $success;
        return $response;
    }

    # xoá mã
    public function clearCoupon()
    {
        removeCoupon();
        return $this->couponApplyFailed('Đã bỏ mã giảm giá', true);
    }

    # lấy thông tin giỏ hàng
    private function getCartsInfo($message = '', $couponDiscount = true, $couponCode = '', $alert = 'success')
    {
        $carts = null;
        if (Auth::check()) {
            $carts          = Cart::where('user_id', Auth::user()->id)->get();
        } else {
            $carts          = Cart::where('guest_user_id', (int) $_COOKIE['guest_user_id'])->get();
        }
        $formattedAmount = NULL;
        if ($couponCode) {
            $voucherType = VoucherType::where('name', $couponCode)->first();
            $formattedAmount = '';
            if ($voucherType->discount_type === 'flat') {
                $formattedAmount = format_cash($voucherType->discount);
            } else {
                $formattedAmount = $voucherType->discount . '%';
            }
        }
        return [
            'success'           => true,
            'message'           => $message,
            'alert'             => $alert,
            'carts'             => getRender('clients.partials.cart-listing', ['carts' => $carts]),
            'navCarts'          => getRender('clients.partials.cart-navbar', ['carts' => $carts]),
            'cartCount'         => count($carts),
            'subTotal'          => format_cash(getSubTotal($carts, $couponDiscount, $couponCode)),
            'couponCode'        => isset($voucherType) ? $voucherType->name : null,
            'couponDiscount'    => format_cash(getCouponDiscount(getSubTotal($carts, false), $couponCode)),
            'couponData'        => $formattedAmount,
            'coupon'            => getRender('clients.partials.coupon', ['carts' => $carts]),
        ];
    }
    public function infoCoupon(Request $request)
    {
        return $this->applyCoupon($request);
    }
    public function getCoupon(Request $request)
    {
        $currentTime = now()->toDateTimeString();

        $coupons = Voucher::where('index', 1)
            ->where('expired_date', '>', $currentTime)
            ->get();
        if (Auth::check()) {
            $coupons = $coupons->sortByDesc(function ($coupon) use ($request) {
                $used = $coupon->usages()->where('user_id', $request->user()->id)->exists();
                return [$coupon->voucherType->discount, $used ? 1 : 0]; // 1 nếu đã sử dụng, 0 nếu chưa
            });
        }

        return [
            'success' => true,
            'coupon' => getRender('clients.partials.voucher_listing', ['coupons' => $coupons]),
        ];
    }
}
