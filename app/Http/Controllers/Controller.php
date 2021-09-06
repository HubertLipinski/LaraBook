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
 *      description="Localhost server"
 * ),
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
