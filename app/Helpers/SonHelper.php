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

