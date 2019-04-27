<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Comment;

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

            // テストコメントの1-400を親コメントにして
            // それ以降は返信コメントにする
            if (1 <= $i && $i <= 400) {
                $comment_reply = 0;
                $topic_id = $faker->numberBetween(1, 100);
            } else {
                $comment_reply = $faker->numberBetween(1, 400);
                // 親、返信コメントのトピックIDを合わせる
                $topic_id = Comment::find($comment_reply)->topic_id;
            }

            $date = $faker->dateTimeBetween('-1 years', 'now')->format('Y-m-d H:i:s');

            Comment::create([
                "user_id" => $faker->numberBetween(1, 50),
                "topic_id" => $topic_id,
                "comment_reply" => $comment_reply,
                "message" => "「サンプルコメント{$i}」"
                    . $faker->realText($faker->numberBetween(30, 200)),
                "vote" => $faker->numberBetween(0, 70),
                "created_at" => $date,
                "updated_at" => $date,
            ]);
        }
    }
}
