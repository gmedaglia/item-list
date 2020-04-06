<?php

namespace App\Http\Requests;

class ItemOrderRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            '*.id' => 'required|exists:items,_id',
            '*.order' => 'required|integer'
        ];
    }
}
