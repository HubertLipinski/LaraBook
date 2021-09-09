<?php

namespace App\Services\User;

use App\Models\Book;
use App\Models\User;
use App\Models\UserBook;
use App\Services\Utils\ConstService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class UserBookService
{
    private Book $book;
    private User $user;
    private UserBook $userBook;

    /**
     * @param Book $book
     * @param User $user
     * @param UserBook $userBook
     */
    public function __construct(Book $book, User $user, UserBook $userBook)
    {
        $this->book = $book;
        $this->user = $user;
        $this->userBook = $userBook;
    }

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

    /**
     * @param int $user_id
     * @param int $book_id
     *
     * @return UserBook|null
     */
    public function addUserBook(int $user_id, int $book_id): ?UserBook
    {
        $check = $this->canCreateRelation($user_id, $book_id);
        if (! $check) {
            return null;
        }

        return $this->userBook->updateOrCreate([
            'user_id' => $user_id,
            'book_id' => $book_id,
        ]);
    }

    /**
     * @param int $user_id
     * @param int $book_id
     *
     * @return bool
     */
    private function canCreateRelation(int $user_id, int $book_id): bool
    {
        $userExist = $this->user->where('id', '=', $user_id)->exists();
        $bookExist = $this->book->where('id', '=', $book_id)->exists();

        return $userExist && $bookExist;
    }
}
