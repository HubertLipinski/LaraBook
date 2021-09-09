<?php

namespace App\Http\Requests\Book;

use App\Http\Requests\BaseFormRequest;

class BookSearchRequest extends BaseFormRequest
{
    /**
     * @OA\Parameter(
     *     parameter="book_search_id",
     *     name="id",
     *     in="query",
     *     description="Filter books by id",
     *     required=false,
     *     @OA\Schema(type="integer"),
     * ),
     * @OA\Parameter(
     *     parameter="book_search_title",
     *     name="title",
     *     in="query",
     *     description="Filter books by title",
     *     required=false,
     *     @OA\Schema(type="string"),
     * ),
     * @OA\Parameter(
     *     parameter="book_search_description",
     *     name="description",
     *     in="query",
     *     description="Filter books by description",
     *     required=false,
     *     @OA\Schema(type="string"),
     * ),
     * @OA\Parameter(
     *     parameter="book_search_short_description",
     *     name="short_description",
     *     in="query",
     *     description="Filter books by short description",
     *     required=false,
     *     @OA\Schema(type="string"),
     * ),
     * @OA\Parameter(
     *     parameter="book_search_user_id",
     *     name="user_id",
     *     in="query",
     *     description="Filter books by owner id",
     *     required=false,
     *     @OA\Schema(type="integer"),
     * ),
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
            'id' => 'sometimes|integer',
            'title' => 'sometimes|string',
            'description' => 'sometimes|string',
            'short_description' => 'sometimes|string',
            'user_id' => 'sometimes|integer',
        ];
    }
}
