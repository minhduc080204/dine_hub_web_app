<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        $title = 'Quản lý thẻ';
        return view('admin.pages.tag.index', compact('tags', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm thẻ mới';
        return view('admin.pages.tag.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request)
    {
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->save();
        toastr()->success('Thêm thẻ mới thành công');
        return to_route('admin.tag.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag, $id)
    {
        $tag = Tag::find($id);
        $title = 'Sửa thẻ mới';
        return view('admin.pages.tag.edit', compact('tag', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag = new Tag;
        $tag->name = $request->name;
        $tag->save();
        toastr()->success('Sửa thẻ thành công');
        return to_route('admin.tag.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function remove(Tag $tag, $id)
    {
        $tag->where("id", $id)->delete();
        toastr()->success('Xoá thẻ thành công');
        return to_route('admin.tag.index');
    }
}