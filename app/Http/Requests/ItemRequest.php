<?php

namespace App\Http\Requests;

class ItemRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => 'required',
            'description' => 'required|max:300'
        ];
    }
}
