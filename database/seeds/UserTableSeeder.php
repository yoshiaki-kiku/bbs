<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 管理ユーザー
        factory(App\User::class)->create([
            'name' => "admin",
            'email' => "admin@mail",
            "password" => bcrypt('pass'),
        ]);

        // 一般ユーザー
        factory(App\User::class)->create([
            'name' => "user",
            'email' => "user@mail",
            "password" => bcrypt('pass'),
        ]);

        factory(App\User::class, 50)->create();
    }
}
