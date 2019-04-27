<?php

use Faker\Generator as Faker;
use App\Models\Topic;

$factory->define(Topic::class, function (Faker $faker) {
    $date = $faker->dateTimeBetween('-1 years', 'now')->format('Y-m-d H:i:s');
    return [
        "title" => $faker->realText($faker->numberBetween(10,30)),
        "user_id" => $faker->numberBetween(1, 50),
        "message" => $faker->realText($faker->numberBetween(30,200)),
        "created_at" => $date,
        "updated_at" => $date,
    ];
});
