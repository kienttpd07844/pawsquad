<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\Social\SaveProviderData;
use App\Http\Controllers\Auth\Helpers\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Cache;

/**
 * @tags Auth
 */
class SocialController extends Controller
{
    use AuthenticatesUsers, SaveProviderData;

    private array $network = [
        'google' => 'google',
    ];
    private array $networkChecker;

    private string $serviceNotFound = 'Mạng xã hội "%s" không có sẵn.';
    private string $serviceNotEnabled = 'Mạng xã hội "%s" không được kích hoạt.';
    private string $serviceError = "Lỗi không xác định. Dịch vụ không hoạt động.";

    public function __construct()
    {
        $this->networkChecker = [
            'google' => (
                env('GOOGLE_CLIENT_ID')
                && env('GOOGLE_CLIENT_SECRET')
            ),
        ];
    }
    public function getProviderTargetUrl(string $provider = "google")
    {
        if (!is_array($this->network) || !isset($this->network[$provider])) {
            $message = sprintf($this->serviceNotFound, $provider);
            return redirect()->route('login')->with(noti($message, type: 'error'));
        }

        $serviceKey = $this->network[$provider];
        try {
            $socialiteObj = Socialite::driver($serviceKey)
                ->stateless();
            return redirect()->to($socialiteObj->redirect()->getTargetUrl());
        } catch (\Throwable $e) {
            $message = $e->getMessage();
            if (empty($message)) {
                $message = $this->serviceError;
            }
            dd($message);
            return redirect()->route('login')->with(noti($message, type: 'error'));
        }
    }



    public function handleProviderCallback(Request $request, $provider = "google")
{
    $serviceKey = $this->network[$provider] ?? null;
    if (empty($serviceKey)) {
        $message = sprintf($this->serviceNotFound, $provider);
        return redirect()->route('login')->with(noti($message, type: 'error'));
    }

    try {
        $authCode = request()->input('code');
        if (empty($authCode)) {
            return redirect()->route('login')->with(noti('Authorization code không hợp lệ', type: 'error'));
        }

        $socialiteUser = Socialite::driver($serviceKey)->stateless()->user();
        if (!$socialiteUser) {
            return redirect()->route('login')->with(noti('Lỗi không xác định, vui lòng thử lại', type: 'error'));
        }

        if (!filter_var($socialiteUser->getEmail(), FILTER_VALIDATE_EMAIL)) {
            return redirect()->route('login')->with(noti('Email không hợp lệ', type: 'error'));
        }

        $user = $this->saveUser($provider, $socialiteUser);

        if ($user) {
            return redirect()->route('home')->with(noti('Đăng nhập thành công!', type: 'success'));
        } else {
            return redirect()->route('login')->with(noti('Đăng nhập thất bại, vui lòng thử lại.', type: 'error'));
        }

    } catch (\Throwable $e) {
        $message = $e->getMessage();
        if (empty($message)) {
            $message = $this->serviceError;
        }
        return redirect()->route('login')->with(noti($message, type: 'error'));
    }
}

}
