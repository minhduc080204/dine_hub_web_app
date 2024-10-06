<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.auth');
    }
    public function doLogin(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($credentials)) {
            if (Auth::user()->role == 'admin') {
                toastr()->success('Đăng nhập thành công!');
                return to_route('admin.dashboard.index');
            }
        }
        toastr()->warning('Thông tin đăng nhập không đúng!');
        return redirect()->back();
    }

    public function doLogout()
    { //GET [/admin/doLogout]
        Auth::logout(); //đăng xuất
        toastr()->success('Đăng xuất thành công!'); //Thông báo
        return to_route('account.login'); //CHuyển hướng ra trang login
    }
}