<?php

namespace App\Http\Controllers\Auth\Social;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Illuminate\Support\Facades\Hash;

trait SaveProviderData
{
    private string $userNotSavedError = "Lỗi không xác định. Dữ liệu người dùng lưu thất bại.";

    protected function saveUser(string $provider, SocialiteUser $providerData): User
    {
        try {
            $remoteId = $providerData->getId() ?? NULL;
            $name = $this->getName($providerData);
            $email = $providerData->getEmail();
            $user = User::where('email', $email)->first();
            $ipAddress = request()->ip();
            $key = Config::get('app.key');
            $token = Str::random(16);
            $encryptedToken = encrypt($token, $key);
            if (!$user) {
                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => NULL,
                    'google_token' => $remoteId,
                    'email_verified' => true,
                    'email_verified_at' => now(),
                    'token' => $encryptedToken,
                    'ip_address' => $ipAddress,
                ]);
            } else {
                $user->update([
                    'google_token' => $remoteId,
                    'email_verified' => true,
                    'email_verified_at' => now(),
                    'token' => $encryptedToken,
                    'ip_address' => $ipAddress,
                ]);
            }

            Auth::login($user);
            if (isset($_COOKIE['guest_user_id'])) {
                $carts  = Cart::where('guest_user_id', (int) request()->cookie('guest_user_id'))->get();
                $userId = auth()->user()->id;
                if ($carts) {
                    foreach ($carts as $cart) {
                        $existInUserCart = Cart::where('user_id', $userId)->where('product_variation_id', $cart->product_variation_id)->first();
                        if (!is_null($existInUserCart)) {
                            $existInUserCart->quantity += $cart->quantity;
                            $existInUserCart->save();
                            $cart->delete();
                        } else {
                            $cart->user_id = $userId;
                            $cart->guest_user_id = null;
                            $cart->save();
                        }
                    }
                }
            }
            return $user;
        } catch (\Throwable $e) {
            throw new \Exception($this->userNotSavedError);
        }
    }

    private function getName(SocialiteUser $providerData): ?string
    {
        $name = $providerData->getName();
        return $name ?: 'Người dùng Google';
    }
}
