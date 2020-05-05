<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\OrderMessage;
use Faker\Generator as Faker;

$factory->define(
    OrderMessage::class,
    static function (Faker $faker) {
        return [
            'owner_id' => rand(1,2),
            'text' => $faker->realText()
        ];
    }
);
