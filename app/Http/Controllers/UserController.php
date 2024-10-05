<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileInfoFormRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('clients.user.index');
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
            return redirect()->route('account')->with(noti('Sửa thông tin thành công', 'success'));
        } else {
            return redirect()->route('account')->with(noti('Sửa thông tin thất bại', 'error'));
        }
    }
}
