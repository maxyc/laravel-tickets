<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(
    User::class,
    static function (Faker $faker) {
        return [
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => Hash::make(111),
            'role_id' => User::ROLE_USER
        ];
    }
);
