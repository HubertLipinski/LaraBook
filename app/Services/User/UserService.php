<?php

namespace App\Services\User;

use App\Http\Requests\User\UserStoreRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private User $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param UserStoreRequest $request
     *
     * @return User
     */
    public function storeUser(UserStoreRequest $request): User
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        return $this->user->create($data);
    }
}
