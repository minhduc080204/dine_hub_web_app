<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Exception;
use Request;

class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::all();
        $title = 'Quản lý trượt';
        return view('admin.pages.slide.index', compact('title', 'slides'));
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
        $slide->image = $request->image;
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
        return redirect()->route("admin.slide");
    }
}