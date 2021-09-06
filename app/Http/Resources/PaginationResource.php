<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="PaginationResource",
 *     description="Pagination resource",
 *     @OA\Xml(name="PaginationResource")
 * )
 */
class PaginationResource extends JsonResource
{
    /**
     * @OA\Property(
     *     property="total",
     *     title="total",
     *     description="Total number of items in the data store",
     *     format="int64",
     *     example="0",
     * ),
     * @OA\Property(
     *     property="count",
     *     title="count",
     *     description="Number of items for the current page",
     *     format="int64",
     *     example=0
     * ),
     * @OA\Property(
     *     property="per_page",
     *     title="per_page",
     *     description="Number of items to be shown per page",
     *     format="int64",
     *     example=10
     * ),
     *
     * @OA\Property(
     *     property="current_page",
     *     title="current_page",
     *     description="Current page number",
     *     format="int64",
     *     example=1
     * )
     *
     * @OA\Property(
     *     property="total_pages",
     *     title="total_pages",
     *     description="Last available page number",
     *     format="int64",
     *     example=0
     * ),
     *
     * @OA\Property(
     *     property="links",
     *     type="object",
     *     @OA\Property(property="previous_page", type="string", example="null"),
     *     @OA\Property(property="next_page", type="string", example="null")
     * ),
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
            'total' => $this->total(),
            'count' => $this->count(),
            'per_page' => $this->perPage(),
            'current_page' => $this->currentPage(),
            'total_pages' => $this->lastPage(),
            'links' => [
                'previous_page' => $this->previousPageUrl(),
                'next_page' => $this->nextPageUrl(),
            ],
        ];
    }
}
