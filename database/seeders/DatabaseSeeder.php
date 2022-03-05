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

        foreach (range(1,10) as $index) {
            DB::table('users')->insert([
                'username' => $faker->userName,
                'created_at' => $faker->date,
                'updated_at' => $faker->date,
            ]);
        }
    }
}
