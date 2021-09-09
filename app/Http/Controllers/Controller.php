<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="LaraBook API",
 *      description="LaraBook API",
 *      @OA\Contact(
 *          email="hubertlipinskipl@gmail.com"
 *      ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="https://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * ),
 * @OA\Server(
 *      url="http://localhost/api/",
 *      description="Localhost server",
 * ),
 * @OA\SecurityScheme(
 *     type="oauth2",
 *     description="Authenticate to API",
 *     name="Password Based",
 *     in="header",
 *     scheme="token",
 *     securityScheme="Password Based",
 *     @OA\Flow(
 *         flow="password",
 *         tokenUrl="/oauth/token",
 *         scopes={}
 *     )
 * )
 * @OA\OpenApi(
 *   security={
 *     { "oauth2": {"read:oauth2"} }
 *   }
 * )
 * @OA\Post(
 * path="/oauth/token",
 * summary="Login",
 * description="Login",
 * operationId="Login",
 * tags={ "auth" },
 * @OA\RequestBody(
 *    required=true,
 *    @OA\JsonContent(
 *       required={"grant_type", "client_id", "client_secret", "username", "password"},
 *       @OA\Property(property="grant_type", type="string", example="password"),
 *       @OA\Property(property="client_id", type="string", example="id"),
 *       @OA\Property(property="client_secret", type="string", example="secret"),
 *       @OA\Property(property="username", type="string", format="email", example="user@email.com"),
 *       @OA\Property(property="password", type="string", format="password", example="password"),
 *    ),
 * ),
 * @OA\Response(
 *     response=200,
 *     description="Success response",
 *     content={
 *     @OA\MediaType(
 *     mediaType="application/json",
 *     @OA\Schema(
 *         @OA\Property(property="token_type", type="string", example="Bearer"),
 *         @OA\Property(property="expires_in", type="integer", example="31536000"),
 *         @OA\Property(property="access_token", type="string", example="access_token"),
 *         @OA\Property(property="refresh_token", type="string", example="refresh_token"),
 *     ))
 * }
 * ),
 * @OA\Response(response=401,description="Unauthenticated"),
 * )
 *
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param null $data
     *
     * @return JsonResponse
     */
    final public function responseSuccess($data = null): JsonResponse
    {
        $response = [
            'status' => 'success',
            'status_code' => ResponseAlias::HTTP_OK,
            'data' => $data,
            'errors' => (new \stdClass()),
        ];
        return response()->json($response, ResponseAlias::HTTP_OK);
    }

    /**
     * @param array $data
     *
     * @return JsonResponse
     */
    final public function responseNotFoundError(array $data = []): JsonResponse
    {
        return $this->errorResponse(Response::HTTP_NOT_FOUND, $data);
    }

    /**
     * @param array $data
     *
     * @return JsonResponse
     */
    final public function responseForbiddenError(array $data = []): JsonResponse
    {
        return $this->errorResponse(Response::HTTP_FORBIDDEN, $data);
    }

    /**
     * @param int $status
     * @param array $data
     *
     * @return JsonResponse
     */
    final private function errorResponse(int $status, array $data): JsonResponse
    {
        $response = [
            'status' => 'error',
            'status_code' => $status,
            'errors' => $data,
        ];
        return response()->json($response, $status);
    }
}
