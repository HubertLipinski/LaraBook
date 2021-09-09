<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;
use App\Models\User;
use App\Rules\User\UserEmailRule;

class UserUpdateRequest extends BaseFormRequest
{
    /**
     * @OA\RequestBody(
     *     request="UserUpdateRequest",
     *     description="User update request",
     *     required=true,
     *     @OA\MediaType(
     *         mediaType="multipart/form-data",
     *         @OA\Schema(
     *             @OA\Property(
     *                 property="firstname",
     *                 title="firstname",
     *                 description="User first name",
     *                 format="string",
     *                 example="Jan"
     *             ),
     *             @OA\Property(
     *                 property="lastname",
     *                 title="lastname",
     *                 description="User last name",
     *                 format="string",
     *                 example="Kowalski"
     *             ),
     *             @OA\Property(
     *                 property="email",
     *                 title="User name",
     *                 description="User email",
     *                 format="string",
     *                 example="new@email.com"
     *             ),
     *             @OA\Property(
     *                 property="slug",
     *                 title="slug",
     *                 description="Slug",
     *                 format="string",
     *                 example="jan-kowalski"
     *             ),
     *             @OA\Property(
     *                 property="phone",
     *                 title="phone",
     *                 description="User phone number",
     *                 format="string",
     *                 example="123456789"
     *             ),
     *         )
     *     )
     * )
     */

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @param User $user
     *
     * @return array
     */
    public function rules(User $user): array
    {
        return [
            'firstname' => 'sometimes|string',
            'lastname' => 'sometimes|string',
            'email' => ['sometimes', 'email', 'bail', new UserEmailRule($user)],
            'slug' => 'sometimes|string',
            'phone' => 'sometimes|string|size:9',
        ];
    }
}
