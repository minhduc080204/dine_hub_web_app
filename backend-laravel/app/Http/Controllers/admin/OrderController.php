<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->get();
        $title = 'Đơn hàng';
        return view('admin.pages.order.index', compact('title', 'orders'));
    }
}