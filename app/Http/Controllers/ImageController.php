<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller {
    
    public static function getImageData( Request $request ) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $image = $request->file('image');
    
        $imageName = $image->getClientOriginalName();
        $imageSize = $image->getSize();
        $imageFormat = $image->getClientOriginalExtension();
    
        list($width, $height) = getimagesize($image);
    
        return response()->json([
            'name' => $imageName,
            'size' => $imageSize,
            'format' => $imageFormat,
            'width' => $width,
            'height' => $height,
        ]);
    }

}
