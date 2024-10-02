<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginFormRequest;
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

        return redirect()->route('home')->with(noti('Đăng nhập thành công', 'success'));
    }

}
