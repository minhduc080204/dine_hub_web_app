<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// MODELS
use App\Models\Category;


class CategotyController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return response()->json($category, 200);
    }
}