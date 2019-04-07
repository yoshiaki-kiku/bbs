<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Comment;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create("ja_JP");

        for ($i = 1; $i <= 1500; $i++) {

            if (1 <= $i && $i <= 400) {
                $comment_reply = 0;
            } else {
                $comment_reply = $faker->numberBetween(1, 400);
            }

            $date = $faker->dateTimeBetween('-1 years', 'now')->format('Y-m-d H:i:s');
            Comment::create([
                "user_id" => $faker->numberBetween(1, 50),
                "topic_id" => $faker->numberBetween(1, 100),
                "comment_reply" => $comment_reply,
                "message" => $faker->realText($faker->numberBetween(30, 200)),
                "vote" => $faker->numberBetween(0, 70),
                "created_at" => $date,
                "updated_at" => $date,
            ]);
        }
    }
}
