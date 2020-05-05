<?php

namespace App\UseCases\User;

use App\User;
use Illuminate\Auth\Events\Registered;

class CreateUserService
{
    public function create(array $data)
    {
        $user = User::create($data);

        event(new Registered($user));

        return $user;
    }
}
