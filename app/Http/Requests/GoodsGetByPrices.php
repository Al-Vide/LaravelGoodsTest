<?php

namespace App\Http\Requests;

class GoodsGetByPrices extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'min' => 'required|numeric|min:0',
            'max' => 'required|numeric|min:0',
        ];
    }
}
