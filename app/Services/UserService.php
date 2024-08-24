<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function createOrUpdate($data, $user = null)
    {
        if (blank($user)) {
            $user = new User();
        }

        $user->fill($data);
        $user->save();

        return $user;
    }
}

