<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class BaseFormRequest extends FormRequest
{
    /**
     * @param Validator $validator
     *
     * @return HttpResponseException
     */
    protected function failedValidation(Validator $validator): HttpResponseException
    {
        throw new HttpResponseException(
            response()->json([
                'status' => 'error',
                'status_code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'errors' => (new ValidationException($validator))->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
