<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class BaseFormRequest extends FormRequest
{
    /**
     * @param Validator $validator
     * @throws ValidationException
     */
    protected function failedValidation( Validator $validator ): void
    {
        $response = response( $validator->errors()->first(), 422 );

        throw ( new ValidationException( $validator, $response) )
            ->errorBag( $this->errorBag )
            ->redirectTo( $this->getRedirectUrl() );
    }
}
