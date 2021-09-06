<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="UserResource",
 *     description="User resource",
 *     @OA\Xml(name="UserResource")
 * )
 */
class UserResource extends JsonResource
{
    /**
     * @OA\Property(
     *     property="id",
     *     title="id",
     *     description="User id",
     *     format="integer",
     *     example=1
     * ),
     * @OA\Property(
     *     property="firstname",
     *     title="firstname",
     *     description="User firstname",
     *     format="string",
     *     example="Jan"
     * ),
     * @OA\Property(
     *     property="lastname",
     *     title="lastname",
     *     description="User lastname",
     *     format="string",
     *     example="Kowalski"
     * ),
     * @OA\Property(
     *     property="email",
     *     title="email",
     *     description="User email",
     *     format="string",
     *     example="user@email.com"
     * ),
     * @OA\Property(
     *     property="slug",
     *     title="slug",
     *     description="User slug",
     *     format="string",
     *     example="jan-kowalski"
     * ),
     * @OA\Property(
     *     property="created_at",
     *     title="created_at",
     *     description="User created at",
     *     format="string",
     *     example="2021-09-06T20:58:20.000000Z"
     * ),
     * @OA\Property(
     *     property="updated_at",
     *     title="created_at",
     *     description="User updated at",
     *     format="string",
     *     example="2021-09-06T20:58:20.000000Z"
     * ),
     */

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'slug' => $this->slug,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
