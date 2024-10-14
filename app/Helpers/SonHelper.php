<?php

use App\Models\Article;
use App\Models\Attribute;
use App\Models\AttributeSet;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Variations;
use App\Models\VariationValues;
use App\Models\Voucher;
use App\Models\VoucherType;
use App\Models\VoucherUsage;
use Artesaos\SEOTools\Facades\SEOTools;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

function checkCaptcha(Request $request)
{
    if (getOption('DB_TURN_CAPTCHA_CLOUDFLARE') == 1) {
        $turnstileResponse = $request->input('cf-turnstile-response');
        $response = Http::post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
            'secret' => getOption('DB_SECRET_KEY_CAPTCHA_CLOUDFLARE'),
            'response' => $turnstileResponse,
        ]);
        $result = $response->json();
        if (!$result['success']) {
            return back()->with(noti('Xác minh captcha thất bại', 'error'));
        }
    }
    if (getOption('DB_TURN_CAPTCHA_GOOGLE') == 1) {
        $recaptchaResponse = $request->input('g-recaptcha-response');
        $response = Http::post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => getOption('DB_SECRET_KEY_CAPTCHA_GOOGLE'),
            'response' => $recaptchaResponse,
        ]);

        $result = $response->json();

        if (!$result['success']) {
            return back()->with(noti('Xác minh captcha thất bại', 'error'));
        }
    }
    return null;
}

function nameRole($role)
{
    switch ($role) {
        case 10:
            return 'ADMIN';
        case 9:
            return 'STAFF';
        case 1:
            return 'CTV';
        case 0:
            return 'Người dùng';
        case 'guest':
            return 'Khách';
        default:
            return 'Vai trò không xác định';
    }
}

function format_date($data)
{
    return \Carbon\Carbon::parse($data)->format('d/m/Y H:i:s');
}
function format_cash($price)
{
    return str_replace(",", ".", number_format($price)) . 'đ';
}
function generateSlug($string, $type, $id = null)
{
    $slug = Str::lower(Str::slug($string, '-'));
    $count = 1;

    switch ($type) {
        case 'category':
            while (Category::select('slug')
                ->where('slug', $slug)
                ->where('id', '!=', $id) // Bỏ qua nếu ID hiện tại trùng
                ->exists()
            ) {
                $slug = $slug . '-' . $count;
                $count++;
            }
            break;
        case 'attributeset':
            while (AttributeSet::select('slug')
                ->where('slug', $slug)
                ->where('id', '!=', $id)
                ->exists()
            ) {
                $slug = $slug . '-' . $count;
                $count++;
            }
            break;
        case 'attribute':
            while (Attribute::select('slug')
                ->where('slug', $slug)
                ->where('id', '!=', $id)
                ->exists()
            ) {
                $slug = $slug . '-' . $count;
                $count++;
            }
            break;
        case 'brand':
            while (Brand::select('slug')
                ->where('slug', $slug)
                ->where('id', '!=', $id)
                ->exists()
            ) {
                $slug = $slug . '-' . $count;
                $count++;
            }
            break;
        case 'product':
            while (Product::select('slug')
                ->where('slug', $slug)
                ->where('id', '!=', $id)
                ->exists()
            ) {
                $slug = $slug . '-' . $count;
                $count++;
            }
            break;
        case 'article':
            while (Article::select('slug')
                ->where('slug', $slug)
                ->where('id', '!=', $id)
                ->exists()
            ) {
                $slug = $slug . '-' . $count;
                $count++;
            }
            break;
        case 'blog':
            while (Blog::select('slug')
                ->where('slug', $slug)
                ->where('id', '!=', $id)
                ->exists()
            ) {
                $slug = $slug . '-' . $count;
                $count++;
            }
            break;
        default:
            return null;
    }

    return $slug;
}

function deleteImages($imagePaths)
{
    // Kiểm tra xem biến $imagePaths có phải là một mảng hay không
    if (is_array($imagePaths)) {
        foreach ($imagePaths as $path) {
            // Kiểm tra nếu $path là một mảng, ta sẽ lấy giá trị đầu tiên của nó
            if (is_array($path)) {
                $path = $path[0]; // Lấy đường dẫn ảnh từ mảng con
            }

            $basepath = base_path($path);
            // Xóa từng ảnh
            if (file_exists($basepath)) {
                unlink($basepath);
            }
        }
    } else {
        $basepath = base_path($imagePaths);
        // Xóa một ảnh
        if (file_exists($basepath)) {
            unlink($basepath);
        }
    }
}

function generateVariationOptions($options, $withTrash = true)
{

    if (count($options) == 0) {
        return $options;
    }
    $variation_ids = array();
    foreach ($options as $option) {

        $value_ids = array();
        if (isset($variation_ids[$option->variation_id])) {
            $value_ids = $variation_ids[$option->variation_id];
        }
        if (!in_array($option->variation_value_id, $value_ids)) {
            array_push($value_ids, $option->variation_value_id);
        }
        $variation_ids[$option->variation_id] = $value_ids;
    }
    $options = array();
    foreach ($variation_ids as $id => $values) {
        $variationValues = array();
        foreach ($values as $value) {
            $variationValue = VariationValues::find($value);
            $val = array(
                'id'   => $value,
                'name' => $variationValue->name,
                'code' => $variationValue->color_code
            );
            array_push($variationValues, $val);
        }
        $data['id'] = $id;

        if ($withTrash == true) {
            $data['name'] = Variations::withTrashed()->find($id)->name;
        } else {
            $data['name'] = Variations::find($id) ? Variations::find($id)->name : null;
        }
        if ($data['name']) {
            $data['values'] = $variationValues;
        } else {
            $data['values'] = $variationValues;
        }

        array_push($options, $data);
    }
    return $options;
}
function mergeImageWithList($image, $imageList)
{
    $decodedImageList = json_decode($imageList, true);

    // Kiểm tra nếu giải mã không thành công
    if (json_last_error() !== JSON_ERROR_NONE) {
        return $imageList; // Trả về danh sách gốc nếu có lỗi
    }

    $found = false;

    foreach ($decodedImageList as $item) {
        // Kiểm tra nếu hình ảnh đã tồn tại trong một trong các mảng con
        if (in_array($image, $item)) {
            $found = true;
            break;
        }
    }

    // Nếu chưa tồn tại trong danh sách, thêm hình ảnh vào đầu mảng
    if (!$found) {
        array_unshift($decodedImageList, [$image]);
    }

    return $decodedImageList;
}
function removeCoupon()
{
    if (request()->hasCookie('coupon_code')) {
        $response = new Response();
        Cookie::queue(Cookie::forget('coupon_code'));
        Cookie::queue(Cookie::forget('coupon_data'));
        return $response;
    }
}


function setCoupon($coupon)
{
    $theTime = now()->addDays(7)->timestamp;
    return Cookie::queue('coupon_code', $coupon->name, $theTime);
}

function setCouponTypeDiscount($amount, $type)
{
    $theTime = now()->addDays(7)->timestamp;

    $formattedAmount = '';
    if ($type === 'flat') {
        $formattedAmount = format_cash($amount);
    } else {
        $formattedAmount = $amount . '%';
    }
    return Cookie::queue('coupon_data', $formattedAmount, $theTime);
}

function getCoupon($type = "default")
{
    if ($type == "default") {
        if (request()->hasHeader("Coupon-Code")) {
            return request()->header("Coupon-Code");
        }
        if (request()->hasCookie('coupon_code')) {
            return request()->cookie('coupon_code');
        }
    }
    if ($type == "coupon_data") {
        if (request()->hasCookie('coupon_data')) {
            return request()->cookie('coupon_data');
        }
    }

    return '';
}


function checkCouponValidityForCheckout($carts)
{
    if (getCoupon() != '') {
        $voucherType = VoucherType::where('name', getCoupon())->first();
        if ($voucherType) {
            $voucher = Voucher::where('voucher_type_id', $voucherType->id)->first();
            $currentDateTime = Carbon::now()->toDateTimeString();
            if ($voucher->voucher_quantity <= 0) {
                removeCoupon();
                return [
                    'status'    => false,
                    'message'   => 'Mã giảm giá đã hết lượt'
                ];
            }
            # total coupon usage
            $totalCouponUsage = VoucherUsage::where('name', $voucherType->name)->sum('usage_count');
            if ($totalCouponUsage > $voucherType->customer_usage_limit) {
                # coupon usage limit reached
                removeCoupon();
                return [
                    'status'    => false,
                    'message'   => 'Mã giảm giá đã sử dụng'
                ];
            }

            if ($voucher->start_date > $currentDateTime) {
                removeCoupon();
                return [
                    'status'    => false,
                    'message'   => 'Mã giảm giá chưa đến thời gian bắt đầu'
                ];
            }
            if ($voucher->expired_date < $currentDateTime) {
                removeCoupon();
                return [
                    'status'    => false,
                    'message'   => 'Mã giảm giá đã hết hạn'
                ];
            }
            if ($voucher->start_date <= $currentDateTime && $voucher->expired_date >= $currentDateTime) {
                $subTotal = (float) getSubTotal($carts, false);
                if ($subTotal >= (float) $voucherType->min_spend) {
                    return [
                        'status'    => true,
                        'message'   => ''
                    ];
                } else {
                    removeCoupon();
                    return [
                        'status'    => false,
                        'message'   => 'Không đạt được số tiền tối thiểu để sử dụng phiếu giảm giá này'
                    ];
                }
            } else {
                removeCoupon();
                return [
                    'status'    => false,
                    'message'   => 'Mã giảm giá đã hết hạn hoặc chưa bắt đầu'
                ];
            }
        } else {
            removeCoupon();
            return [
                'status'    => false,
                'message'   => 'Mã giảm giá không tồn tại'
            ];
        }
    }

    return [
        'status'    => true,
        'message'   => ''
    ];
}
function getSubTotal($carts, $couponDiscount = true, $couponCode = '')
{
    $price = 0;
    $amount = 0;
    if (count($carts) > 0) {
        foreach ($carts as $cart) {
            $variation  = $cart->product_variation;
            $price += (float) $variation->price * $cart->quantity;
        }

        if ($couponDiscount) {
            $amount = getCouponDiscount($price, $couponCode);
        }
    }

    return $price - $amount;
}
function getCouponDiscount($subTotal, $code = '')
{
    $amount = 0;
    $voucherType = VoucherType::where('name', $code)->first();
    if ($voucherType) {
        $voucher = Voucher::where('voucher_type_id', $voucherType->id)->first();
        $currentDate = Carbon::now()->toDateString();
        # kiểm tra
        if ($voucher->start_date <= $currentDate && $voucher->expired_date >= $currentDate) {
            if ($voucherType->discount_type == 'flat') {
                $amount = $subTotal - (float) $voucherType->discount;
            } else {
                $amount = $subTotal - ((float) $voucherType->discount * $subTotal) / 100;
            }
            if ($amount < 0) {
                $amount = 0;
            }
        } else {
            removeCoupon();
        }
    } else {
        removeCoupon();
    }

    return $amount;
}
