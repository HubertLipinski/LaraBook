<?php

namespace App\Services\Book;

use App\Filters\BookFilters;
use App\Http\Requests\Book\BookSearchRequest;
use App\Models\Book;
use App\Services\Utils\ConstService;
use Illuminate\Pagination\LengthAwarePaginator;

class BookSearchService
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
     * @param BookSearchRequest $request
     * @param BookFilters $filters
     *
     * @return LengthAwarePaginator
     */
    public function searchBooks(BookSearchRequest $request, BookFilters $filters): LengthAwarePaginator
    {
        $perPage = (int) $request->get('per_page', ConstService::DEFAULT_PER_PAGE);

        return $this->book
            ->filter($filters)
            ->paginate($perPage);
    }
}
