<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Resources\User\UserResource;
use App\Services\User\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * path="/user/store",
     * summary="Store user",
     * description="Store user",
     * operationId="store",
     * tags={ "user" },
     * security={ {"Password Based": {} }},
     * @OA\RequestBody(ref="#/components/requestBodies/UserStoreRequest"),
     * @OA\Response(
     *     response=200,
     *     description="Success response",
     *     @OA\Property(property="status", type="string", example="success"),
     *     @OA\Property(property="status_code", type="integer", example=200),
     *     @OA\Property(property="data", type="object",
     *         @OA\Property(property="user", ref="#/components/schemas/UserResource")
     *     ),
     *     @OA\Property(property="errors", type="object")
     * ),
     * @OA\Response(response=401,description="Unauthenticated"),
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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
