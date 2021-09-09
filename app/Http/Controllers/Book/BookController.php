<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\BookStoreRequest;
use App\Http\Requests\Book\BookUpdateRequest;
use App\Http\Resources\Book\BookResource;
use App\Services\Book\BookService;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    private BookService $bookService;

    /**
     * @param BookService $bookService
     */
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * @OA\Post(
     * path="/book",
     * summary="Store book",
     * description="Store book",
     * operationId="store",
     * tags={ "book" },
     * security={ {"Password Based": {} }},
     * @OA\RequestBody(ref="#/components/requestBodies/BookStoreRequest"),
     * @OA\Response(
     *     response=200,
     *     description="Success response",
     *     content={
     *     @OA\MediaType(
     *     mediaType="application/json",
     *     @OA\Schema(
     *         @OA\Property(property="status", type="string", example="success"),
     *         @OA\Property(property="status_code", type="integer", example=200),
     *         @OA\Property(property="data", type="object",
     *             @OA\Property(property="book", ref="#/components/schemas/BookResource")
     *         ),
     *         @OA\Property(property="errors", type="object")
     *     ))
     * }
     * ),
     * @OA\Response(response=401, description="Unauthenticated"),
     * @OA\Response(response=422, description="Unprocessable Entity"),
     * )
     *
     * @param BookStoreRequest $request
     *
     * @return JsonResponse
     */
    public function store(BookStoreRequest $request): JsonResponse
    {
        $book = $this->bookService->storeBook($request);
        return $this->responseSuccess(['book' => new BookResource($book)]);
    }

    /**
     * @OA\Put(
     * path="/book/{book_id}",
     * summary="Update book",
     * description="Update book",
     * operationId="update",
     * tags={ "book" },
     * security={ {"Password Based": {} }},
     * @OA\RequestBody(ref="#/components/requestBodies/BookUpdateRequest"),
     * @OA\Parameter(
     *   name="book_id",
     *   in="path",
     *   description="Book id",
     *   required=true,
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Success response",
     *     content={
     *     @OA\MediaType(
     *     mediaType="application/json",
     *     @OA\Schema(
     *         @OA\Property(property="status", type="string", example="success"),
     *         @OA\Property(property="status_code", type="integer", example=200),
     *         @OA\Property(property="data", type="object",
     *             @OA\Property(property="book", ref="#/components/schemas/BookResource")
     *         ),
     *         @OA\Property(property="errors", type="object")
     *     ))
     * }
     * ),
     * @OA\Response(response=401, description="Unauthenticated"),
     * @OA\Response(response=404, description="Not found"),
     * @OA\Response(response=422, description="Unprocessable Entity"),
     * )
     *
     * @param BookUpdateRequest $request
     * @param int $book_id
     *
     * @return JsonResponse
     */
    public function update(BookUpdateRequest $request, int $book_id): JsonResponse
    {
        $book = $this->bookService->updateBook($book_id, $request);

        if (! is_null($book)) {
            return $this->responseSuccess(['book' => new BookResource($book)]);
        }

        return $this->responseNotFoundError(['message' => 'Book not found']);
    }

    /**
     * @OA\Delete(
     * path="/book/{book_id}",
     * summary="Delete book",
     * description="Delete book",
     * operationId="destroy",
     * tags={ "book" },
     * security={ {"Password Based": {} }},
     * @OA\Parameter(
     *   name="book_id",
     *   in="path",
     *   description="Book id",
     *   required=true,
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Success response",
     *     content={
     *     @OA\MediaType(
     *     mediaType="application/json",
     *     @OA\Schema(
     *         @OA\Property(property="status", type="string", example="success"),
     *         @OA\Property(property="status_code", type="integer", example=200),
     *         @OA\Property(property="data", type="object",
     *             @OA\Property(property="message", example="Book deleted")
     *         ),
     *         @OA\Property(property="errors", type="object")
     *     ))
     * }
     * ),
     * @OA\Response(response=401, description="Unauthenticated"),
     * @OA\Response(response=403, description="Forbidden"),
     * @OA\Response(response=404, description="Not found"),
     * )
     *
     * @param int $book_id
     *
     * @return JsonResponse
     */
    public function destroy(int $book_id): JsonResponse
    {
        $deleted = $this->bookService->deleteBook($book_id);

        if (! $deleted) {
            return $this->responseForbiddenError(['message' => 'Access denied']);
        }

        return $this->responseSuccess(['message' => 'Book deleted']);
    }
}
