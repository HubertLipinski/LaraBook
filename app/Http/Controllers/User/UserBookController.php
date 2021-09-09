<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Book\BookCollection;
use App\Services\User\UserBookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserBookController extends Controller
{
    private UserBookService $userBookService;

    /**
     * @param UserBookService $userBookService
     */
    public function __construct(UserBookService $userBookService)
    {
        $this->userBookService = $userBookService;
    }

    /**
     * @OA\Get(
     * path="/book",
     * summary="Get user's book list",
     * description="Get user's book list",
     * operationId="getList",
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
     * )
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getList(Request $request): JsonResponse
    {
        $list = $this->userBookService->getUserBookList($request);
        return $this->responseSuccess(new BookCollection($list));
    }

    /**
     * @OA\Post(
     * path="/user/{user_id}/book/{book_id}",
     * summary="Add user book",
     * description="Add user book",
     * operationId="storeUserBook",
     * tags={ "user" },
     * security={ {"Password Based": {} }},
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
     *             @OA\Property(property="message", example="Book added")
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
     * @param int $user_id
     * @param int $book_id
     *
     * @return JsonResponse
     */
    public function storeUserBook(int $user_id, int $book_id): JsonResponse
    {
        $userBook = $this->userBookService->addUserBook($user_id, $book_id);

        if (! is_null($userBook)) {
            return $this->responseSuccess(['message' => 'Book added']);
        }

        return $this->responseForbiddenError(['message' => 'Access denied']);
    }
}
