<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TopicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create("ja_JP");

        for ($i = 1; $i <= 100; $i++) {
            factory(App\Models\Topic::class)->create([
                "title" => "「サンプルタイトル{$i}」"
                    . $faker->realText($faker->numberBetween(10, 30)),
                "message" => "サンプルメッセージ、"
                    . $faker->realText($faker->numberBetween(30, 200)),
            ]);
        }
    }
}
