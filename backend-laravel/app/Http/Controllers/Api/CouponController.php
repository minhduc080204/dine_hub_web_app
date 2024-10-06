<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $discounts = Coupon::all();
        return response()->json($discounts, 200);
    }

    public function checkDiscount(Request $request){
        $code = $request->input('code');
        $discount = Coupon::where('code', $code)->first();
        if ($discount) {
            $expiresAt = new \DateTime($discount->expires_at);
            $now = new \DateTime();
            if ($expiresAt >= $now) {
                return response()->json(['discount' => $discount->discount, 'code'=> 200]);
            }
            return response()->json([ 'message' => 'Discount code has expired', 'code'=> 400]);
        }
        return response()->json(['message' => 'Discount code not found', 'code'=> 402]);
    }
}