<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Storage;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        $title = 'Quản lý danh mục';
        return view('admin.pages.category.index', compact('title', 'categories'));
    }
    public function create()
    {
        $title = 'Thêm danh mục mới';
        return view('admin.pages.category.createCategory', compact('title'));
    }
    public function store(CategoryRequest $request)
    {        
        $category = new Category();
        $category->name = $request->name;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            uploadImage($image, $category, 'categories');
        }        
        $category->save();
        toastr()->success('Thêm danh mục thành công');
        return to_route('admin.category.index');
    }
    public function editView($id)
    {
        $category = Category::where("id", $id)->get();
        $title = 'Chỉnh sửa danh mục';
        return view('admin.pages.category.editCategory', compact('title', 'category'));
    }

    public function edit(Request $request, $id)
    {

        $oldCategory = $request->input('oldCategory'); // Giá trị cũ cần thay thế
        $newCategory = $request->input('newCategory'); // Giá trị mới
        $category = Category::find($id);
        $category->name = $newCategory;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            uploadImage($image, $category, 'categories');
        }        
        $category->save();
        // Cập nhật các bản ghi có chứa oldCategory
        Product::whereJsonContains('category', $oldCategory)
            ->get()
            ->each(function ($product) use ($oldCategory, $newCategory) {
                $categories = json_decode($product->category, true);
                $categories = array_map(function ($item) use ($oldCategory, $newCategory) {
                    return $item == $oldCategory ? $newCategory : $item;
                }, $categories);
                $product->category = json_encode($categories);
                $product->save();
            });

        toastr()->success('Cập nhật danh mục thành công!');
        return redirect()->route("admin.category.index");
    }

    public function remove($id)
    {
        try {
            Category::where("id", $id)->delete();
            toastr()->success('Xoá danh mục thành công!');
        } catch (Exception $e) {
            toastr()->error('Xoá danh mục thất bại!');
        }
        return redirect()->route("admin.category.index");
    }
}