<?php

namespace App\Http\Requests\Book;

use App\Http\Requests\BaseFormRequest;

class BookStoreRequest extends BaseFormRequest
{
    /**
     * @OA\RequestBody(
     *     request="BookStoreRequest",
     *     description="Book store request",
     *     required=true,
     *     @OA\MediaType(
     *         mediaType="multipart/form-data",
     *         @OA\Schema(
     *             required={
     *                  "title",
     *                  "description",
     *                  "short_description",
     *             },
     *             @OA\Property(
     *                 property="title",
     *                 title="title",
     *                 description="Book title",
     *                 format="string",
     *                 example="Title"
     *             ),
     *             @OA\Property(
     *                 property="description",
     *                 title="description",
     *                 description="Book description",
     *                 format="string",
     *                 example="Description"
     *             ),
     *             @OA\Property(
     *                 property="short_description",
     *                 title="Short description",
     *                 description="Book short description",
     *                 format="string",
     *                 example="Short description"
     *             ),
     *         )
     *     )
     * )
     */

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
