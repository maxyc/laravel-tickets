<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(
    Order::class,
    static function (Faker $faker) {
        $rand = Order::getAvailableStatuses()->keys()->random(1)->first();

        return [
            'title' => $faker->text(100),
            'note' => $faker->text,
            'owner_id' => 2,
            'is_read'=>$faker->boolean,
            'has_answer'=>$faker->boolean,
            'status' => $rand
        ];
    }
);
