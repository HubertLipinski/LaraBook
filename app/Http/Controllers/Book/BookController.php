<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\BookStoreRequest;
use App\Http\Requests\Book\BookUpdateRequest;
use App\Services\Book\BookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

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
     * Store a newly created resource in storage.
     *
     * @param BookStoreRequest $request
     *
     * @return JsonResponse
     */
    public function store(BookStoreRequest $request): JsonResponse
    {
        $book = $this->bookService->storeBook($request);
        return $this->responseSuccess($book);
    }

    /**
     * Update the specified resource in storage.
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
            return $this->responseSuccess($book);
        }

        return $this->responseNotFoundError(['message' => 'Book not found']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
