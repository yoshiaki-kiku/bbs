<?php

use Faker\Generator as Faker;
use App\CommentReply;

$factory->define(CommentReply::class, function (Faker $faker) {
    $date = $faker->dateTimeBetween('-1 years', 'now')->format('Y-m-d H:i:s');
    return [
        "user_id" => $faker->numberBetween(1, 50),
        "comment_id" => $faker->numberBetween(1, 1200),
        "message" => $faker->realText($faker->numberBetween(30,200)),
        "vote" => $faker->numberBetween(1, 70),
        "created_at" => $date,
        "updated_at" => $date,
    ];
});
