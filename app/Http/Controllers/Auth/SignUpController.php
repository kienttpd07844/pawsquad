<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignupFormRequest;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Proengsoft\JsValidation\Facades\JsValidatorFacade;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class SignUpController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect(route('home'));
        }
        return view('clients.auth.signup');
    }
    public function postSignup(SignupFormRequest $request)
    {
        if (Auth::check()) {
            return redirect(route('home'));
        }
        if (User::where('email', $request->email)->exists()) {
            throw ValidationException::withMessages([
                'email' => 'Email này đã tồn tại trong hệ thống',
            ]);
        }
        if (User::where('phone', $request->phone)->exists()) {
            throw ValidationException::withMessages([
                'phone' => 'Số điện thoại này đã tồn tại trong hệ thống',
            ]);
        }
        $key = Config::get('app.key');
        $token = Str::random(16);
        $encryptedToken = encrypt($token, $key);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'ip_address' => $request->ip(),
            'token' => $encryptedToken,
        ]);
        if ($user) {
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
            return redirect()->route('home')->with(noti('Đăng ký thành công', 'success'));
        } else {
            return redirect()->route('signup')->with(noti('Đăng ký thất bại', 'error'));
        }
    }
}
