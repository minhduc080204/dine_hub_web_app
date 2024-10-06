<?php

use Illuminate\Support\Facades\Storage;

function uploadImage($request, $product)
{
    $filename = $request->getClientOriginalName();
    $filePath = 'products/' . $filename;
    $product->image = $filePath;
    if (!Storage::disk('public')->exists($filePath)) {
        return $request->storeAs('images/products', $filename, 'public');
    }
    return $filename;
}
