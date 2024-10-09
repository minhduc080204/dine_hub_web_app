<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SlideRequest;
use App\Models\Slide;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::all();
        $title = 'Quản lý trượt';
        return view('admin.pages.slide.index', compact('title', 'slides'));
    }

    public function create()
    {
        $title = 'Thêm Slide mới';
        return view('admin.pages.slide.createSlide', compact('title'));
    }
    public function store(SlideRequest $request)
    {
        $slide = new Slide();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            uploadImage($image, $slide, 'slides');
        }
        $slide->save();
        toastr()->success('Thêm slide thành công');
        return to_route('admin.slide.index');
    }

    public function editView($id)
    {
        $slide = Slide::find($id);
        $title = 'Chỉnh sửa trượt';
        return view('admin.pages.slide.editSlide', compact('title', 'slide'));
    }

    public function edit(Request $request, $id)
    {
        $slide = Slide::find($id);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            uploadImage($image, $slide, 'slides');
        }
        $slide->save();
        return to_route('admin.slide.index');
    }

    public function remove($id)
    {
        try {
            Slide::where("id", $id)->delete();
            toastr()->success('Data has been removed successfully!');
        } catch (Exception $e) {
            toastr()->error('Removed failed!');
        }
        return redirect()->route("admin.slide.index");
    }
}