<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\ProfileInfoFormRequest;
use App\Models\Address;
use App\Models\Province;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index()
    {
        $addresses = Address::with(['province', 'district', 'ward', 'village'])
        ->where('user_id', auth()->user()->id)
        ->get()
        ->sortByDesc('is_default');
        $provinces = Province::orderBy('name')->get();
        return view('clients.user.index',compact('addresses','provinces'));
    }
    public function postEdit(ProfileInfoFormRequest $request)
    {
        $user = auth()->user();
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();
        if ($user) {
            return redirect()->to(route('account') . '#thong-tin')->with(noti('Sửa thông tin thành công', 'success'));
        } else {
            return redirect()->to(route('account') . '#thong-tin')->with(noti('Sửa thông tin thất bại', 'error'));
        }
    }

    public function verify()
    {

        if (!is_null(auth()->user()->email_verified_at) && !is_null(auth()->user()->email_verified) ) {
            return redirect()->route('home')->with(noti('Tài khoản đã xác thực.', 'warning'));
        }
        return view('clients.auth.verify');
    }
    public function postVerify(Request $request)
    {
        $user = Auth::user();
        $error = Helper::throttle('sendMailVerify', 1, 3, 'mi');
        if ($error) {
            throw ValidationException::withMessages([
                'verify' => $error,
            ]);
        }
        if (!is_null($user->email_verified_at)) {
            return redirect()->route('home')->with(noti('Tài khoản đã xác thực.', 'warning'));
        }
        $user = User::where('id', auth()->user()->id)->first();
        $user->sendEmailVerificationNotificationCustom();
        return redirect()->route('verify')->with(noti('Đã gửi mail thành công.', 'success'));
    }
    public function checkVerify($id, $hash){
        try {
            $decodedId = Crypt::decryptString($id);
            if (!$decodedId) {
                return redirect()->route('verify')->with(noti('Liên kết không hợp lệ.', 'error'));
            }

            if (!URL::hasValidSignature(request())) {
                return redirect()->route('verify')->with(noti('Liên kết không hợp lệ.', 'error'));
            }
            $user = User::findOrFail($decodedId);

            if (!hash_equals(sha1($user->getEmailForVerification()), $hash)) {
                return redirect()->route('verify')->with(noti('Liên kết không hợp lệ.', 'error'));
            }

            if ($user->hasVerifiedEmail() && $user->email_verified_at != 1) {
                return redirect()->route('verify')->with(noti('Email đã được xác minh.', 'warning'));
            }
            $user->markEmailAsVerifiedCustom();
            return redirect()->route('home')->with(noti('Xác minh email thành công!', 'success'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('verify')->with(noti('Không tìm thấy người dùng.', 'error'));
        } catch (\Exception $e) {
            return redirect()->route('verify')->with(noti('Đã xảy ra lỗi.', 'error'));
        }
    }
}
