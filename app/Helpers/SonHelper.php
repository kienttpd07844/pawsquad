<?php

use App\Models\Article;
use App\Models\Attribute;
use App\Models\AttributeSet;
use App\Models\Blog;
use App\Models\Category;
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
function generateSlug($string, $type)
{
    $slug = Str::lower(Str::slug($string, '-'));
    $count = 1;
    switch ($type) {
        case 'category':
            while (Category::select('slug')->where('slug', $slug)->exists()) {
                $slug = $slug . '-' . $count;
                $count++;
            }
            break;
        case 'attributeset':
            while (AttributeSet::select('slug')->where('slug', $slug)->exists()) {
                $slug = $slug . '-' . $count;
                $count++;
            }
            break;
        case 'attribute':
            while (Attribute::select('slug')->where('slug', $slug)->exists()) {
                $slug = $slug . '-' . $count;
                $count++;
            }
            break;
        case 'article':
            while (Article::select('slug')->where('slug', $slug)->exists()) {
                $slug = $slug . '-' . $count;
                $count++;
            }
            break;
        case 'blog':
            while (Blog::select('slug')->where('slug', $slug)->exists()) {
                $slug = $slug . '-' . $count;
                $count++;
            }
            break;
        default:
            return NULL;
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

function systemLog($action, $additional_info = [],$type = "default")
{
    $user_id = auth()->check() ? auth()->user()->id : NULL;
    $ip_address = request()->ip();
    $user_agent = request()->header('User-Agent');

    // Xử lý theo từng loại log
    switch ($type) {
        case 'default':
            \App\Models\AdminLog::create([
                'user_id'        => $user_id,            // ID người dùng
                'action'         => $action,             // Mô tả hành động
                'ip_address'     => $ip_address,         // Địa chỉ IP của người dùng
                'user_agent'     => $user_agent,         // Trình duyệt/người dùng
                'additional_info'=> json_encode($additional_info), // Thông tin bổ sung (JSON)
                'created_at'     => now(),               // Thời gian hành động
            ]);
            break;

        case 'login':
            // Trường hợp custom log, ví dụ ghi log theo cách đặc biệt
            \App\Models\AdminLog::create([
                'user_id'        => $user_id,
                'action'         => '[LOGIN] ' . $action,
                'ip_address'     => $ip_address,
                'user_agent'     => $user_agent,
                'additional_info'=> json_encode(array_merge($additional_info, ['login' => true])),
                'created_at'     => now(),
            ]);
            break;

        case 'error':
            // Ghi log cho trường hợp lỗi
            \App\Models\AdminLog::create([
                'user_id'        => $user_id,
                'action'         => '[ERROR] ' . $action, // Gắn nhãn error cho action
                'ip_address'     => $ip_address,
                'user_agent'     => $user_agent,
                'additional_info'=> json_encode(array_merge($additional_info, ['severity' => 'high'])),
                'created_at'     => now(),
            ]);
            break;

        default:
            // Xử lý trường hợp không khớp với bất kỳ loại nào
            \App\Models\AdminLog::create([
                'user_id'        => $user_id,
                'action'         => '[UNKNOWN] ' . $action,
                'ip_address'     => $ip_address,
                'user_agent'     => $user_agent,
                'additional_info'=> json_encode($additional_info),
                'created_at'     => now(),
            ]);
            break;
    }
}
