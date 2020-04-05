<?php

namespace App\Services

use App\Http\Controllers\Controller;

class UploadService
{
    public function upload($file)
    {
        $file->store('public/images');
        return asset('storage/images/' . $file->hashName());
    }
}
