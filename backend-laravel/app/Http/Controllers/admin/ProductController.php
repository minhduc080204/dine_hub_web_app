<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Tag;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $tag = Tag::all();
        $title = 'Quản lý sản phẩm';
        // dd(abc($products));
        return view('admin.pages.product.index', compact('title', 'products', 'tag'));
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
        $tag = new Tag();
        $product->name = $request->name;
        $product->weight = $request->weight;
        $product->calories = $request->calories;
        $product->price = $request->price;
        if ($request->hasFile('image')) {
            uploadImage($request->file('image'), $product);
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
        $tags = json_decode($request->tag, true);
        $values_tags = array_map(function ($item) {
            return $item['value'];
        }, $tags);
        foreach ($values_tags as $item) {
            $tag_id = Tag::where('name', $item)->pluck('id')->first();
            if ($tag_id) {
                $product->tags()->attach($tag_id);
            } else {
                dd('Tag not found: ' . $item);
            }
        }

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
        $tag = Tag::all();
        return view('admin.pages.product.edit', compact('title', 'product', 'tag'));
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
                uploadImage($request->file('image'), $product);
            }
            $product->description = $request->description;
            $product->is_bestseller = $request->is_bestseller;
            $product->is_new = $request->is_new;
            $categories = json_decode($request->category, true);
            $values_categories = array_map(function ($item) {
                return $item['value'];
            }, $categories);
            $product->category = json_encode($values_categories);
            $product->save();

            $tags = json_decode($request->tag, true);
            $values_tags = array_map(function ($item) {
                return $item['value'];
            }, $tags);
            $tag_ids = [];
            foreach ($values_tags as $item) {
                $tag_id = Tag::where('name', $item)->pluck('id')->first();
                if ($tag_id) {
                    $tag_ids[] = $tag_id;
                } else {
                    dd('Tag not found: ' . $item);
                }
            }
            $product->tags()->sync($tag_ids);

            toastr()->success('Cập nhật sản phẩm thành công');
            return to_route('admin.product.index');
        } catch (\Exception $e) {
            return toastr()->error('Đã có lỗi xảy ra trong quá trình cập nhật sản phẩm.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function remove(string $id)
    {
        $product = Product::where("id", $id)->delete();
        toastr()->success('Xoá sản phẩm thành công!');
        return to_route('admin.product.index');
    }
}