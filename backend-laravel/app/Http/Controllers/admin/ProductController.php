<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        // $products = Product::all();
        $title = 'Sản phẩm';
        return view('admin.pages.product.index', compact('title', 'products'));
    }
    public function create()
    {
        $title = 'Thêm sản phẩm mới';
        return view('admin.pages.product.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        // $product->images = $request->images;
        // $product->sizes = $request->sizes;
        // $product->size = $request->size;
        // $product->colors = $request->colors;
        // $product->color = $request->color;
        // $product->is_featured = $request->is_featured;
        // $product->is_out_of_stock = $request->is_out_of_stock;
        // $product->old_price = $request->old_price;
        // $product->quantity = $request->quantity;
        // $product->reviews = $request->reviews;
        // dd($request->file('image'));
        $product = new Product();
        $product->name = $request->name;
        $product->weight = $request->weight;
        $product->calories = $request->calories;
        $product->price = $request->price;
        if ($request->hasFile('image')) {
            $filename = $request->file('image')->getClientOriginalName();
            $filePath = 'images/products/' . $filename;
            $product->image = $filename;
            if (!Storage::disk('public')->exists($filePath)) {
                $request->file('image')->storeAs('images/products', $filename, 'public');
            }
        }
        $product->description = $request->description;
        $product->is_bestseller = $request->is_bestseller;
        $product->is_new = $request->is_new;
        $category = json_decode($request->category, true);
        $values = array_map(function ($item) {
            return $item['value'];
        }, $category);
        $product->category = json_encode($values);
        $product->save();
        toastr()->success('Thêm sản phẩm thành công');
        return to_route('admin.product.index');
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
        $title = 'Chỉnh sửa sản phẩm';
        $product = Product::find($id);
        return view('admin.pages.product.edit', compact('title', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, string $id)
    {
        try {
            $product = Product::find($id);
            $product->name = $request->name;
            $product->weight = $request->weight;
            $product->calories = $request->calories;
            $product->price = $request->price;
            if ($request->hasFile('image')) {
                $filename = $request->file('image')->getClientOriginalName();
                $filePath = 'images/products/' . $filename;
                $product->image = $filename;
                if (!Storage::disk('public')->exists($filePath)) {
                    $request->file('image')->storeAs('images/products', $filename, 'public');
                }
            }
            $product->description = $request->description;
            $product->is_bestseller = $request->is_bestseller;
            $product->is_new = $request->is_new;
            $category = json_decode($request->category, true);
            $values = array_map(function ($item) {
                return $item['value'];
            }, $category);
            $product->category = json_encode($values);
            $product->save();
            toastr()->success('Cập nhật sản phẩm thành công');
            return to_route('admin.product.index');
        } catch (\Exception $e) {
            return toastr()->error('Đã có lỗi xảy ra trong quá trình cập nhật sản phẩm.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}