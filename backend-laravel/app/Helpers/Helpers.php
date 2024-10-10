<?php

use Illuminate\Support\Facades\Storage;

function uploadImage($image, $product, $folder)
{
    $filename = $image->getClientOriginalName();
    $filePath = $folder . '/' . $filename;
    if (!Storage::disk('public')->exists($filePath)) {
        $image->storeAs('images/' . $folder, $filename, 'public');
    }
    $product->image = $filePath;
    return $filename;
}

