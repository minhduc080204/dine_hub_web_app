<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Http\Requests\StoreDiscountRequest;
use App\Http\Requests\UpdateDiscountRequest;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discounts = Discount::all();
        $title = 'Mã giảm giá';
        return view('admin.pages.discount.index', compact('title', 'discounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $discounts = Discount::all();
        $title = 'Thêm mã giảm giá';
        return view('admin.pages.discount.create', compact('title', 'discounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDiscountRequest $request)
    {
        $discount = new Discount;
        $discount->code = $request->code;
        $discount->discount = $request->discount;
        $discount->expires_at = $request->expires_at;
        $discount->save();
        toastr()->success('Thêm mã giảm giá thành công!');
        return to_route('admin.discount.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discount $discount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDiscountRequest $request, Discount $discount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discount $discount)
    {
        //
    }
}