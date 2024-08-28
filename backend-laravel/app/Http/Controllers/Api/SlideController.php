<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slide;

class SlideController extends Controller
{
    public function index()
    {
        $slide = Slide::all();
        return response()->json($slide);
    }
}