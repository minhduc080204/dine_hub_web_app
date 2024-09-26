<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Exception;


class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->get();
        $title = 'Quản lý đơn hàng';
        return view('admin.pages.order.index', compact('title', 'orders'));
    }
    public function detail($id)
    {
        $order = Order::with('user')->find($id);
        $title = 'Chi tiết đơn hàng';
        return view('admin.pages.order.detail', compact('title', 'order'));
    }
    public function remove(Order $order, $id)
    {
        try {
            order::where("id", $id)->delete();
            toastr()->success('Xoá đơn hàng thành công!');
        } catch (Exception $e) {
            toastr()->error('Xoá đơn hàng thất bại!');
        }
        return redirect()->route("admin.order.index");
    }
}