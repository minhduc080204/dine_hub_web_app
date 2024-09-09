<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;

class SlideController extends Controller
{
    public function index(){
        $slides = Slide::get();
        $title = 'Slide';
        return view('admin.pages.slide.index', compact('title','slides'));
    }
}