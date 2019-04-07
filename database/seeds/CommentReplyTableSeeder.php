<?php

use Illuminate\Database\Seeder;

class CommentReplyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\CommentReply::class, 1500)->create();
    }
}
