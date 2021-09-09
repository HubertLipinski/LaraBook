<?php

namespace App\Filters;

use App\Http\Requests\Book\BookSearchRequest;
use Illuminate\Database\Eloquent\Builder;

class BookFilters extends CustomFilters
{
    /**
     * @param BookSearchRequest $request
     */
    public function __construct(BookSearchRequest $request)
    {
        parent::__construct($request);
        $this->request = $request;
    }

    /**
     * @param int $value
     *
     * @return Builder
     */
    public function id(int $value): Builder
    {
        return $this->builder->where('id', '=', $value);
    }

    /**
     * @param string $value
     *
     * @return Builder
     */
    public function title(string $value): Builder
    {
        $search = $this->getSearchString($value);
        return $this->builder->where('title', 'like', $search);
    }

    /**
     * @param string $value
     *
     * @return Builder
     */
    public function description(string $value): Builder
    {
        $search = $this->getSearchString($value);
        return $this->builder->where('description', 'like', $search);
    }

    /**
     * @param string $value
     *
     * @return Builder
     */
    public function shortDescription(string $value): Builder
    {
        $search = $this->getSearchString($value);
        return $this->builder->where('short_description', 'like', $search);
    }

    /**
     * @param int $value
     *
     * @return Builder
     */
    public function userId(int $value): Builder
    {
        return $this->builder->whereHas('userBook', function ($query) use ($value) {
            $query->where('user_id', '=', $value);
        });
    }

    /**
     * @param string $value
     *
     * @return string
     */
    private function getSearchString(string $value): string
    {
        return '%' . $value . '%';
    }
}
