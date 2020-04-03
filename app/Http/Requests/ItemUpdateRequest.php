<?php

namespace App\Http\Requests;

class ItemUpdateRequest extends ItemRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return parent::rules() + [
            'order' => 'required|integer'
        ];
    } 
}
