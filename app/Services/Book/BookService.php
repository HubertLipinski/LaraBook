<?php

namespace App\Services\Book;

use App\Http\Requests\Book\BookStoreRequest;
use App\Http\Requests\Book\BookUpdateRequest;
use App\Models\Book;

class BookService
{
    private Book $book;

    /**
     * @param Book $book
     */
    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
     * @param BookStoreRequest $request
     *
     * @return Book
     */
    public function storeBook(BookStoreRequest $request): Book
    {
        $validated = $request->validated();
        $validated['description'] = htmlentities($validated['description']);
        return $this->book->create($validated);
    }

    /**
     * @param int $book_id
     * @param BookUpdateRequest $request
     *
     * @return Book|null
     */
    public function updateBook(int $book_id, BookUpdateRequest $request): ?Book
    {
        $book = $this->book->find($book_id);
        if (is_null($book)) {
            return null;
        }
        $validated = $request->validated();
        $description = $request->get('description', $book->description);
        $validated['description'] = htmlentities($description);
        $this->book->update($validated);
        return $book;
    }

    /**
     * @param int $book_id
     *
     * @return bool
     */
    public function deleteBook(int $book_id): bool
    {
        return true;
    }
}
