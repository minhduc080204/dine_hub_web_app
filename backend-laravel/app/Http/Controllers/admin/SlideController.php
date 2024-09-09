<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Exception;

class SlideController extends Controller
{
    public function index(){
        $slides = Slide::get();
        $title = 'Carousel';
        return view('admin.pages.slide.index', compact('title', 'slides'));
    }

    public function editView($id){
        $slide = Slide::where("id", $id)->get();    
        $title = 'Edit Carousel';    
        return view('admin.pages.slide.editSlide', compact('title', 'slide'));
    }

    public function edit($id){
        // Slide::where("id", $id)->delete(); 
        return  redirect()->route("admin.slide");
    }

    public function remove($id){
        try{
            // Slide::where("id", $id)->delete(); 
            toastr()->success('Data has been removed successfully!');
        }catch(Exception $e){
            toastr()->error('Removed failed!');
        }
        return  redirect()->route("admin.slide");
    }
}