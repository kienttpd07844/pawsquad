<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\ResetPasswordFormRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function index(Request $request){
        $check = DB::table('password_reset_tokens')->where('email', $request->email)->first();
        $status = false;
        if ($check && $request->token) {
            if ($check->token === $request->token) {
                $createdAt = Carbon::parse($check->created_at);
                $expiresAt = $createdAt->addMinutes(60);
                $currentTime = now();
                if ($currentTime->lte($expiresAt)) { // Nếu thời gian hiện tại nhỏ hơn hoặc bằng thời gian hết hạn
                    //less than or equal to - nhỏ hơn hoặc bằng
                    $status = true;
                    session(['reset_email' => $check->email, 'reset_token' => $check->token]);
                } else {
                    $status = false;
                }
            }
        }
        if (Auth::check()) {
            return redirect(route('home'));
        }
        return view('clients.auth.reset',compact('status'));
    }
    public function postReset(ResetPasswordFormRequest $request){
        $email = session('reset_email');
        $token = session('reset_token');
        $check = DB::table('password_reset_tokens')->where('email', $email)->first();
        if ($check && $token) {
            if ($check->token === $token) {
                $createdAt = Carbon::parse($check->created_at);
                $expiresAt = $createdAt->addMinutes(60);
                $currentTime = now();
                if ($currentTime->lte($expiresAt)) {
                    $user = User::where('email', $email)->first();
                    if ($user) {
                        $user->password = Hash::make($request->password);
                        $user->save();
                        DB::table('password_reset_tokens')->where('email', $email)->delete();
                        session()->forget('reset_email');
                        session()->forget('reset_token');
                        return redirect()->route('login')->with(noti('Thay đổi mật khẩu thành công.', 'success'));
                    }
                }
            }
        }
        abort(404);
    }
}
