<?php

namespace App\Http\Requests\Book;

use App\Http\Requests\BaseFormRequest;

class BookUpdateRequest extends BaseFormRequest
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
            'title' => 'sometimes|string',
            'description' => 'sometimes|string',
            'short_description' => 'sometimes|string|max:255',
        ];
    }
}
