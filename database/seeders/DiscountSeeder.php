<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DiscountSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('vi_VN');
        $gameIds = DB::table('games')->pluck('game_id')->toArray();
        
        $eventTypes = ['Tết Event', 'Summer Sale', 'Black Friday', 'Christmas Event', 'Anniversary'];

        for ($i = 0; $i < 10; $i++) {
            DB::table('discount')->insert([
                'game_id' => $faker->randomElement($gameIds),
                'event_name' => $faker->randomElement($eventTypes) . ' ' . $faker->year(),
                'banner_url' => $faker->imageUrl(1200, 400, 'games'),
                'event_link' => $faker->url(),
                'created_at' => $faker->dateTimeBetween('-6 months', 'now')
            ]);
        }
    }
}