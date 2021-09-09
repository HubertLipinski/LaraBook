<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\User\UserResource;
use App\Services\User\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @OA\Post(
     * path="/user",
     * summary="Store user",
     * description="Store user",
     * operationId="store",
     * tags={ "user" },
     * security={},
     * @OA\RequestBody(ref="#/components/requestBodies/UserStoreRequest"),
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
     *             @OA\Property(property="user", ref="#/components/schemas/UserResource")
     *         ),
     *         @OA\Property(property="errors", type="object")
     *     ))
     * }
     * ),
     * @OA\Response(response=401, description="Unauthenticated"),
     * @OA\Response(response=422, description="Unprocessable Entity"),
     * )
     *
     * @param UserStoreRequest $request
     *
     * @return JsonResponse
     */
    public function store(UserStoreRequest $request): JsonResponse
    {
        $user = $this->userService->storeUser($request);

        return $this->responseSuccess(['user' => new UserResource($user)]);
    }

    /**
     * @OA\Put(
     * path="/user/{user_id}",
     * summary="Update user",
     * description="Update user",
     * operationId="update",
     * tags={ "user" },
     * security={ {"Password Based": {} }},
     * @OA\Parameter(
     *   name="user_id",
     *   in="path",
     *   description="User id",
     *   required=true,
     * ),
     * @OA\RequestBody(ref="#/components/requestBodies/UserUpdateRequest"),
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
     *             @OA\Property(property="user", ref="#/components/schemas/UserResource")
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
     * @param UserUpdateRequest $request
     * @param int $user_id
     *
     * @return JsonResponse
     */
    public function update(UserUpdateRequest $request, int $user_id): JsonResponse
    {
        $userUpdated = $this->userService->updateUser($user_id, $request);

        if (! is_null($userUpdated)) {
            return $this->responseSuccess(['user' => new UserResource($userUpdated)]);
        }

        return $this->responseNotFoundError(['message' => 'User not found']);
    }

    /**
     * @OA\Delete(
     * path="/user/{user_id}",
     * summary="Delete user",
     * description="Delete user",
     * operationId="destroy",
     * tags={ "user" },
     * security={ {"Password Based": {} }},
     * @OA\Parameter(
     *   name="user_id",
     *   in="path",
     *   description="User id",
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
     *             @OA\Property(property="message", example="User deleted")
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
     *
     * @return JsonResponse
     */
    public function destroy(int $user_id): JsonResponse
    {
        $deleted = $this->userService->deleteUser($user_id);

        if (! $deleted) {
            return $this->responseForbiddenError(['message' => 'Access denied']);
        }

        return $this->responseSuccess(['message' => 'User deleted']);
    }
}
