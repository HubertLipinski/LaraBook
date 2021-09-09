<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rules\Password;

class UserStoreRequest extends BaseFormRequest
{
    /**
     * @OA\RequestBody(
     *     request="UserStoreRequest",
     *     description="User store request",
     *     required=true,
     *     @OA\MediaType(
     *         mediaType="multipart/form-data",
     *         @OA\Schema(
     *             required={
     *                  "firstname",
     *                  "lastname",
     *                  "email",
     *                  "slug",
     *                  "password",
     *                  "phone",
     *             },
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
     *                 example="user@email.com"
     *             ),
     *             @OA\Property(
     *                 property="slug",
     *                 title="slug",
     *                 description="Slug",
     *                 format="string",
     *                 example="jan-kowalski"
     *             ),
     *             @OA\Property(
     *                 property="password",
     *                 title="password",
     *                 description="Password",
     *                 format="password",
     *                 example="password"
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'slug' => 'required|string',
            'password' => ['required', Password::defaults()],
            'phone' => 'required|string|size:9',
        ];
    }
}
