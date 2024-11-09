<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use Exception;
class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::all();
        $title = 'Quản lý mã giảm giá';
        return view('admin.pages.coupon.index', compact('title', 'coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $coupons = Coupon::all();
        $title = 'Thêm mã giảm giá';
        return view('admin.pages.coupon.create', compact('title', 'coupons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCouponRequest $request)
    {
        $coupon = new Coupon;
        $coupon->code = $request->code;
        $coupon->discount = $request->discount;
        $coupon->expires_at = $request->expires_at;
        $coupon->save();
        toastr()->success('Thêm mã giảm giá thành công!');
        return to_route('admin.coupon.index');
    }
    public function reload()
    {
        Coupon::where('expires_at', '<', now())->delete();
        toastr()->success('Cập nhật trạng thái mã giảm giá thành công');
        return redirect()->back();
    }
    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon, $id)
    {
        $coupon = Coupon::find($id);
        $title = 'Sửa mã giảm giá';
        return view('admin.pages.coupon.edit', compact('title', 'coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecouponRequest $request, coupon $coupon, $id)
    {
        $coupon = Coupon::find($id);
        $coupon->code = $request->code;
        $coupon->discount = $request->discount;
        $coupon->expires_at = $request->expires_at;
        $coupon->save();
        toastr()->success('sữa mã giảm giá thành công!');
        return to_route('admin.coupon.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function remove(coupon $coupon, $id)
    {
        try {
            coupon::where("id", $id)->delete();
            toastr()->success('Xoá mã giảm giá thành công!');
        } catch (Exception $e) {
            toastr()->error('Xoá mã giảm giá thất bại!');
        }
        return redirect()->route("admin.coupon.index");
    }
}