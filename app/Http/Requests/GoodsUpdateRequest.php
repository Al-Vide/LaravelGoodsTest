<?php

namespace App\Http\Requests;

class GoodsUpdateRequest extends BaseFormRequest
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
            'name'         => 'required|string|max:255',
            'description'  => 'present|string|nullable',
            'price'        => 'required|numeric|min:0',
            'is_published' => 'required|boolean',
        ];
    }
}