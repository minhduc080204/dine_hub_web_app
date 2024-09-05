<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index(){
        $user = User::with('orders')->get();
        return response()->json($user);
    }
    public function select($id){
        $user = User::with('orders')->where('id',$id)->get();
        return response()->json($user);
    }
    public function newOrder(Request $request){
        try {
            $validated = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'phone_number' => 'required|string',
                'address' => 'required|string',
                'total_price' => 'required|numeric',
                'subtotal_price' => 'required|numeric',
                'delivery_price' => 'required|numeric',
                'discount' => 'required|numeric',
                'payment_status' => 'required|string',
                'order_status' => 'required|string',
                'created_at' => 'required|date',
                'product_id' => 'required|integer|exists:products,id',
            ]);
    
            // Tạo đơn hàng mới
            $order = Order::create($validated);
    
            return response()->json(['id' => $order->id], 201);
        } catch (\Exception $e) {
            // Ghi lỗi vào log
            Log::error('Order creation failed: ' . $e->getMessage());
        
            return response()->json(['error' => 'Order creation failed', 'message' => $e->getMessage()], 500);
          }
    }
}
