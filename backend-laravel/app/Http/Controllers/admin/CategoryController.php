<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categogies = Category::get();
        $title = 'Danh mục';
        return view('admin.pages.category.index', compact('title', 'categogies'));
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

        toastr()->success('Cập nhật dữ liệu thành công!');
        return redirect()->route("admin.category");
    }

    public function remove($id)
    {
        try {
            // Slide::where("id", $id)->delete(); 
            toastr()->success('Xoá dữ liệu thành công!');
        } catch (Exception $e) {
            toastr()->error('Xoá dữ liệu thất bại!');
        }
        return redirect()->route("admin.category");
    }
}