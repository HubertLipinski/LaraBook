<?php

namespace App\Http\Resources\Book;

use App\Http\Resources\PaginationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @OA\Schema(
 *     title="BookCollection",
 *     description="Book collection",
 *     @OA\Xml(name="BookCollection")
 * )
 */
class BookCollection extends ResourceCollection
{
    /**
     * @OA\Property(
     *     property="books",
     *     title="books",
     *     description="Array of books",
     *     format="array",
     *     type="array",
     *     @OA\Items(ref="#/components/schemas/BookResource")
     * ),
     * @OA\Property(
     *     property="pagination",
     *     title="pagination",
     *     description="Collection pagination data",
     *     ref="#/components/schemas/PaginationResource",
     * )
     */

    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'books' => BookResource::collection($this->collection),
            'pagination' => new PaginationResource($this->resource)
        ];
    }
}
