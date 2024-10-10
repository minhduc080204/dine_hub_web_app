<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
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
        $order = Order::with('user','products')->find($id);
        foreach (json_decode($order->product_id) as $product_id){
        $product = Product::where('id', $product_id)->first();
        $products[] = $product;
        };
        $title = 'Chi tiết đơn hàng';
        return view('admin.pages.order.detail', compact('title', 'order', 'products'));
    }
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        if ($request->input('action') == 'accept') {
            $order->order_status = 'accepted'; 
        } elseif ($request->input('action') == 'cancel') {
            $order->order_status = 'canceled'; 
        }
        $order->save();
        toastr()->success('Đơn hàng đã được cập nhật!');
        return redirect()->route('admin.order.index');
    }
    public function remove(Order $order, $id)
    {
        try {
            order::where('id', $id)->delete();
            toastr()->success('Xoá đơn hàng thành công!');
        } catch (Exception $e) {
            toastr()->error('Xoá đơn hàng thất bại!');
        }
        return redirect()->route("admin.order.index");
    }
}