<?php

namespace App\Services\User;

use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use App\Notifications\UserAccountDeletedNotification;
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

    /**
     * @param int $user_id
     * @param UserUpdateRequest $request
     *
     * @return User|null
     */
    public function updateUser(int $user_id, UserUpdateRequest $request): ?User
    {
        $user = $this->user->find($user_id);
        if (is_null($user)) {
            return null;
        }

        $user->fill($request->validated())->save();

        return $user;
    }

    /**
     * @param int $user_id
     *
     * @return bool
     */
    public function deleteUser(int $user_id): bool
    {
        $user = $this->user->find($user_id);
        if (is_null($user) || ! auth()->user()->can('delete', $user)) {
            return false;
        }

        $user->notify(new UserAccountDeletedNotification());
        $user->delete();

        return true;
    }
}
