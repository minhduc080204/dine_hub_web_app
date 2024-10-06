<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $title = 'Quản lý người dùng';
        return view('admin.pages.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::all();
        $title = 'Thêm người dùng';
        return view('admin.pages.user.create', compact('user', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = new User();
        $user->user_name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->role = $request->role;
        $user->save();
        toastr()->success('Thêm người dùng thàng công!!');
        return to_route('admin.user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $title = 'Chỉnh sửa người dùng';
        return view('admin.pages.user.edit', compact('user', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUserRequest $request, string $id)
    {
        $user = User::find($id);
        $user->user_name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->role = $request->role;
        $user->save();
        toastr()->success('Cập nhật người dùng thàng công!!');
        return to_route('admin.user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function remove(string $id)
    {
        $user = User::find($id);
        $user->delete();
        toastr()->success('Xoá người dùng thành công!');
        return to_route('admin.user.index');
    }
}