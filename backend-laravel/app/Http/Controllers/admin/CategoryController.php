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
        $title = 'Category';
        return view('admin.pages.category.index', compact('title', 'categogies'));
    }

    public function editView($id)
    {
        $category = Category::where("id", $id)->get();
        $title = 'Edit Category';
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
                // Lấy danh sách category hiện tại từ JSON
                $categories = json_decode($product->category, true);

                // Thay thế giá trị cũ bằng giá trị mới
                $categories = array_map(function ($item) use ($oldCategory, $newCategory) {
                    return $item == $oldCategory ? $newCategory : $item;
                }, $categories);

                // Cập nhật lại cột category
                $product->category = json_encode($categories);
                $product->save();
            });
        
        toastr()->success('Data has been update successfully!');
        return redirect()->route("admin.category");
    }

    public function remove($id)
    {
        try {
            // Slide::where("id", $id)->delete(); 
            toastr()->success('Data has been removed successfully!');
        } catch (Exception $e) {
            toastr()->error('Removed failed!');
        }
        return  redirect()->route("admin.category");
    }
}
