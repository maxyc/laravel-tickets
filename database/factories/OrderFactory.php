<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(
    Order::class,
    static function (Faker $faker) {
        $rand = array_rand(Order::getAvailableStatuses(), 1);

        return [
            'title' => $faker->text(100),
            'note' => $faker->text,
            'owner_id' => 2,
            'is_read'=>$faker->boolean,
            'has_answer'=>$faker->boolean,
            'status' => Order::getAvailableStatuses()[$rand]
        ];
    }
);
