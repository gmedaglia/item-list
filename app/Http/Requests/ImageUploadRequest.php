<?php

namespace App\Http\Requests;

class ImageUploadRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => 'required|image|mimes:jpg,jpeg,gif,png|dimensions:width=320,height=320',
        ];
    } 
}
