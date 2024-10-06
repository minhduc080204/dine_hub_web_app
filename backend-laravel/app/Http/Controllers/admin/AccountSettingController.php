<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\changePasswordRequest;
use Illuminate\Support\Facades\Hash;
class AccountSettingController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $title = 'Cài đặt tài khoản';
        return view('admin.pages.account-setting.index', compact('user', 'title'));
    }
    public function changeInfo()
    {
        $user = auth()->user();
        $title = 'Cài đặt tài khoản';
        return view('admin.pages.account-setting.index', compact('user', 'title'));
    }
    public function changePassword(changePasswordRequest $request)
    {
        $user = auth()->user();

        if (Hash::check($request->old_password, $user->password)) {

            $user->password = Hash::make($request->new_password);
            $user->save();

            toastr()->success('Thay đổi mật khẩu thành công!');
            return to_route('admin.account-setting.index');
        } else {
            return to_route('admin.account-setting.index');
        }

    }
    public function vest()
    {
        $user = auth()->user();
        $title = 'Cài đặt tài khoản';
        return view('admin.pages.account-setting.index', compact('user', 'title'));
    }
}
