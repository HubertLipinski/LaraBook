<?php

namespace App\Http\Resources\Book;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="BookResource",
 *     description="Book resource",
 *     @OA\Xml(name="BookResource")
 * )
 */
class BookResource extends JsonResource
{
    /**
     * @OA\Property(
     *     property="id",
     *     title="id",
     *     description="Book id",
     *     format="integer",
     *     example=1
     * ),
     * @OA\Property(
     *     property="title",
     *     title="title",
     *     description="Book title",
     *     format="string",
     *     example="Title"
     * ),
     * @OA\Property(
     *     property="description",
     *     title="description",
     *     description="Book description",
     *     format="string",
     *     example="Description"
     * ),
     * @OA\Property(
     *     property="short_description",
     *     title="short_description",
     *     description="Book short description",
     *     format="string",
     *     example="Short description"
     * ),
     * @OA\Property(
     *     property="created_at",
     *     title="created_at",
     *     description="User created at",
     *     format="string",
     *     example="2021-09-06T20:58:20.000000Z"
     * ),
     * @OA\Property(
     *     property="updated_at",
     *     title="created_at",
     *     description="User updated at",
     *     format="string",
     *     example="2021-09-06T20:58:20.000000Z"
     * )
     */

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'short_description' => $this->short_description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
