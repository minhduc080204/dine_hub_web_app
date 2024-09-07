<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index()
    {
        $order = Order::with('user','products')->get();
        // dd($order);
        return response()->json($order);
    }
    public function select($id)
    {
        $order = Order::with('user')->where('user_id', $id)->get();
        return response()->json($order);
    }
    public function newOrder(Request $request){
        try {
            // Tạo đơn hàng mới
            $order = Order::create([
                'user_id' => $request->input('user_id'),
                'address' => $request->input('address'),
                'note' => $request->input('note'),
                'total_price' => $request->input('total_price'),
                'subtotal_price' => $request->input('subtotal_price'),
                'delivery_price' => $request->input('delivery_price'),
                'discount' => $request->input('discount'),
                'payment_status' => $request->input('payment_status', 'Paid'), // Giá trị mặc định là 'Paid'
                'order_status' => $request->input('order_status', 'Processing'), // Giá trị mặc định là 'Processing'
                'product_id' => json_encode($request->input('product_id')), // Chuyển mảng thành JSON
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Trả về phản hồi JSON với mã đơn hàng vừa tạo
            return true;
        } catch (\Exception $e) {
            // Ghi lỗi vào log nếu có ngoại lệ
            Log::error('Order creation failed: ' . $e->getMessage());

            return false;
        }
    }
}
