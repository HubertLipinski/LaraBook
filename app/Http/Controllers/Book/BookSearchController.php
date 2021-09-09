<?php

namespace App\Http\Controllers\Book;

use App\Filters\BookFilters;
use App\Http\Controllers\Controller;
use App\Http\Requests\Book\BookSearchRequest;
use App\Http\Resources\Book\BookCollection;
use App\Services\Book\BookSearchService;
use Illuminate\Http\JsonResponse;

class BookSearchController extends Controller
{
    private BookSearchService $bookSearchService;

    /**
     * @param BookSearchService $bookSearchService
     */
    public function __construct(BookSearchService $bookSearchService)
    {
        $this->bookSearchService = $bookSearchService;
    }

    /**
     * @OA\Get(
     * path="/book/search",
     * summary="Search book list",
     * description="Search book list",
     * operationId="search",
     * tags={ "book" },
     * security={ {"Password Based": {} }},
     * @OA\Parameter(
     *     name="page",
     *     in="query",
     *     description="Pagination page",
     *     required=false,
     *     @OA\Schema(type="integer"),
     * ),
     * @OA\Parameter(
     *     name="per_page",
     *     in="query",
     *     description="Pagination page",
     *     required=false,
     *     @OA\Schema(type="integer"),
     * ),
     * @OA\Parameter(ref="#/components/parameters/book_search_id"),
     * @OA\Parameter(ref="#/components/parameters/book_search_title"),
     * @OA\Parameter(ref="#/components/parameters/book_search_description"),
     * @OA\Parameter(ref="#/components/parameters/book_search_short_description"),
     * @OA\Parameter(ref="#/components/parameters/book_search_user_id"),
     * @OA\Response(
     *     response=200,
     *     description="Success response",
     *     content={
     *     @OA\MediaType(
     *     mediaType="application/json",
     *     @OA\Schema(
     *         @OA\Property(property="status", type="string", example="success"),
     *         @OA\Property(property="status_code", type="integer", example=200),
     *         @OA\Property(property="data", type="object", ref="#/components/schemas/BookCollection"),
     *         @OA\Property(property="errors", type="object")
     *     ))
     * }
     * ),
     * @OA\Response(response=401, description="Unauthenticated"),
     * @OA\Response(response=422, description="Unprocessable Entity"),
     * )
     *
     * @param BookSearchRequest $request
     * @param BookFilters $filters
     *
     * @return JsonResponse
     */
    public function search(BookSearchRequest $request, BookFilters $filters): JsonResponse
    {
        $results = $this->bookSearchService->searchBooks($request, $filters);
        return $this->responseSuccess(new BookCollection($results));
    }
}
