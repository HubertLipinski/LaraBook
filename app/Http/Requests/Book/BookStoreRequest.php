<?php

namespace App\Http\Requests\Book;

use App\Http\Requests\BaseFormRequest;

class BookStoreRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'short_description' => 'required|string|max:255',
        ];
    }
}
