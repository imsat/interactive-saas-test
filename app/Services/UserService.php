<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    /**
     * Create or update new user.
     *
     * @param $data
     * @param $user
     * @return User|mixed|null
     */
    public function save($data = [], $user = null)
    {
        if (blank($user)) {
            $user = new User();
        }

        $user->fill($data);
        $user->save();
        return $user;
    }
}

