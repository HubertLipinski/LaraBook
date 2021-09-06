<?php

namespace App\Services\User;

use App\Services\Utils\ConstService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class UserBookService
{
    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator
     */
    public function getUserBookList(Request $request): LengthAwarePaginator
    {
        $user = auth()->user();
        $perPage = (int) $request->get('per_page', ConstService::DEFAULT_PER_PAGE);

        return $user->books()
            ->paginate($perPage);
    }
}
