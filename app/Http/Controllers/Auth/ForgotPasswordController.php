<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordFormRequest;
use App\Mail\ResetPassword;
use App\Mail\ThemeMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('clients.auth.forgotpassword');
    }
    public function postForgotPassword(ForgotPasswordFormRequest $request){
        $user = User::where('email', $request->email)->first();

        if (!$user || empty($user)) {
            $error = Helper::throttle('forgotpassword', 3, 2, 'mi');
            if ($error) {
                throw ValidationException::withMessages([
                    'email' => $error,
                ]);
            }
            return redirect()->route('forgotpassword')->with(noti('Tài khoản này không tồn tại', 'error'));
        }
        $error = Helper::throttle('forgotpassword', 1, 2, 'mi');
        if ($error) {
            throw ValidationException::withMessages([
                'email' => $error,
            ]);
        }
        if ($user) {
            $password_reset_tokens =  DB::table('password_reset_tokens')->where('email', $user->email);
            if ($password_reset_tokens->exists()) {
                $password_reset_tokens->delete();
            }
            $key = Config::get('app.key');
            $token = Str::random(16);
            $encryptedToken = encrypt($token, $key);
            $password_reset = DB::table('password_reset_tokens')->insert([
                'email' => $user->email,
                'token' =>  $encryptedToken,
                'created_at' => Carbon::now()
            ]);
            $resetLink = url(config('app.url') . route('password.reset', ['token' => $encryptedToken, 'email' => $user->email], false));
            $dataMail =[
                'name' => $user->name ?? NULL,
                'resetLink' => $resetLink ?? NULL,
                'email' => $user->email ?? NULL,
                'phone' => $user->phone ?? NULL,
            ];
            // $mail = Mail::to($user->email)->send(new ResetPassword($dataMail));
            $mail = Mail::to($user->email)
            ->send((new ThemeMail($dataMail, 'forgotpassword'))->subject('Thay đổi mật khẩu tại ' . env('APP_NAME')));
        }
        if ($user && $mail) {
            return redirect()->route('forgotpassword')->with(noti('Liên kết đặt lại mật khẩu đã được gửi đến email của bạn.', 'success'));
        } else {
            return redirect()->route('forgotpassword')->with(noti('Có lỗi xảy ra khi gửi liên kết đặt lại mật khẩu.', 'warning'));
        }
    }
}
