<?php

namespace App\Http\Controllers\Auth\Social;

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
