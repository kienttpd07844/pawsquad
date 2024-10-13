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
                    $stock = ProductVariationStock::where('product_variation_id',$cart->product_variation->id)->first();
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

                if ($product->stock_qty > $cart->quantity) {
                    $productVariationStock = $cart->product_variation->product_variation_stock;
                    if ($productVariationStock->stock_qty > $cart->quantity) {
                        $cart->quantity += 1;
                        $cart->save();
                        $message =  'Số lượng sản phẩm đã tăng';
                    }
                } else {
                    $message = 'Vượt quá số lượng trong kho';
                    return $this->getCartsInfo($message, true, '', 'warning');
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
            $currentDate = Carbon::now()->toDateString();

            # Kiểm tra xem phiếu giảm giá có hết hạn chưa
            if ($voucher->start_date <= $currentDate && $voucher->expired_date >= $currentDate) {
                $carts = null;
                if (Auth::check()) {
                    $carts  = Cart::where('user_id', Auth::user()->id)->get();
                    if ($voucher->voucher_quantity <= 0) {
                        removeCoupon();
                        return [
                            'status'    => false,
                            'message'   => 'Mã giảm giá đã hết lượt'
                        ];
                    }
                    # total coupon usage

                    $totalCouponUsage = VoucherUsage::where('name', $voucherType->name)->sum('usage_count');
                    if ($totalCouponUsage >= $voucherType->customer_usage_limit) {
                        removeCoupon();
                        return [
                            'status'    => false,
                            'message'   => 'Mã giảm giá đã sử dụng'
                        ];
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
                return $this->couponApplyFailed('Hãy mua sắm ít nhất ' . $voucherType->min_spend);
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
        return $this->couponApplyFailed('Đã xoá mã giảm giá', true);
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
        return [
            'success'           => true,
            'message'           => $message,
            'alert'             => $alert,
            'carts'             => getRender('clients.partials.cart-listing', ['carts' => $carts]),
            'navCarts'          => getRender('clients.partials.cart-navbar', ['carts' => $carts]),
            'cartCount'         => count($carts),
            'subTotal'          => format_cash(getSubTotal($carts, $couponDiscount, $couponCode)),
            'couponDiscount'    => format_cash(getCouponDiscount(getSubTotal($carts, false), $couponCode)),
        ];
    }
}
