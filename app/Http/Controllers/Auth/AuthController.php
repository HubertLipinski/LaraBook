<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @OA\Put(
     * path="/auth/logout",
     * summary="Log out",
     * description="Log out",
     * operationId="logout",
     * tags={ "auth" },
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
     *             @OA\Property(property="message", example="Successfully logged out")
     *         ),
     *         @OA\Property(property="errors", type="object")
     *     ))
     * }
     * ),
     * @OA\Response(response=401,description="Unauthenticated"),
     * )
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        if (Auth::check()) {
            Auth::user()->token()->revoke();
        }
        return $this->responseSuccess(['message' => 'Successfully logged out']);
    }
}
