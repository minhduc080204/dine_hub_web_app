<?php

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


function uploadImage($image, $product, $folder)
{
    $filename = $image->getRealPath();

    $manager = new ImageManager(new Driver());

    $img = $manager->read($filename);
        
    $filePath = $folder . '/i_' . time(). '.jpg';

    $encoded = $img->encodeByMediaType('image/jpeg', progressive: true, quality: 20);

    Storage::disk('public')->put('images/' . $filePath , (string) $encoded);

    $product->image = $filePath;

    return $filePath; // Trả về tên file mới
}