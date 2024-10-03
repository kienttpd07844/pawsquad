<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginFormRequest;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
class LoginController extends Controller
{
    public function index(){
        return view('clients.auth.login');
    }
    public function postLogin(LoginFormRequest $request) {
        $remember = $request->has('remember');

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            throw ValidationException::withMessages([
                'email' => 'Tài khoản hoặc mật khẩu không chính xác.',
            ]);
        }

        User::where('id', Auth::user()->id)->update([
            'ip_address' => $request->ip(),
        ]);
        if (isset($_COOKIE['guest_user_id'])) {
            $carts  = Cart::where('guest_user_id', request()->cookie('guest_user_id'))->get();
            $userId = auth()->user()->id;
            if ($carts) {
                foreach ($carts as $cart) {
                    $existInUserCart = Cart::where('user_id', $userId)->where('product_id', $cart->product_id)->first();
                    if (!is_null($existInUserCart)) {
                        $existInUserCart->qty += $cart->qty;
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
        return redirect()->route('home')->with(noti('Đăng nhập thành công', 'success'));
    }
    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('home')->with(noti('Đăng xuất thành công', 'success'));
    }

}
