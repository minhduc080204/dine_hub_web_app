<?php

namespace App\Http\Controllers\admin;

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
            if (Auth::user()->code == 'admin') {
                toastr()->success('Login success!');
                return redirect()->route('admin.dashboard');
            } else {
                toastr()->warning('You are not an admin!');
                return redirect()->back();
            }
        }
        toastr()->error('Login failed!');
        return redirect()->back();
    }

    public function doLogout()
    { //GET [/admin/doLogout]
        Auth::logout(); //đăng xuất
        toastr()->success('Logout success'); //Thông báo
        return redirect()->route('account.login'); //CHuyển hướng ra trang login
    }
}