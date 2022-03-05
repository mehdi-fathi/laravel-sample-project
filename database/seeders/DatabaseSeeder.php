<?php

namespace Database\Seeders;

use Faker\Provider\Address;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        DB::table('users')->truncate();
        DB::table('posts')->truncate();

        foreach (range(1, 10) as $index) {

            $user_id = $index;

            DB::table('users')->insert([
                'username' => $faker->userName,
                'created_at' => $faker->date,
                'updated_at' => $faker->date,
            ]);

            $total_post = ($index % 5 == 0) ? $total_post = rand(10, 15) : rand(1, 9);

            for ($i = 0; $i < $total_post; $i++) {

                DB::table('posts')->insert([
                    'title' => $faker->title,
                    'user_id' => $user_id,
                    'created_at' => $faker->date,
                    'updated_at' => $faker->date,
                ]);
            }
        }
    }
}
