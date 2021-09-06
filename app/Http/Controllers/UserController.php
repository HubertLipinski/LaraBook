<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/user/test",
     *     summary="test",
     *     description="test",
     *     operationId="test",
     *     tags={"user"},
     *     security={ {"bearer": {} }},
     *     @OA\Response(response=200, description="success")
     * )
     */
    public function test()
    {
        return 1;
    }
}
