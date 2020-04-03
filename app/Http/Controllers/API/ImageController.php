<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageUploadRequest;

class ImageController extends Controller
{
    public function upload(ImageUploadRequest $request)
    {
        $request->image->store('public/images');
        return response(null, 204)
            ->header('Location',  asset('storage/images/' . $request->image->hashName())); 
    }
}
