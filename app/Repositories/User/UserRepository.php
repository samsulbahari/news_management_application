<?php

namespace App\Repositories\User;

use App\Repositories\User\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{

    public function getUserByEmail($email)
    {
        return User::where('email',$email)->first();
    }

}