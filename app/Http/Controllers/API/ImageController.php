<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageUploadRequest;
use Symfony\Component\HttpFoundation\Response;

class ImageController extends Controller
{
    public function upload(ImageUploadRequest $request)
    {
        $request->image->store('public/images');
        return response(null, Response::HTTP_NO_CONTENT)
            ->header('Location',  asset('storage/images/' . $request->image->hashName()));
    }
}
