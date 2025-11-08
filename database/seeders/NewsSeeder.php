<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class NewsSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('vi_VN');
        $gameIds = DB::table('games')->pluck('game_id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            DB::table('news')->insert([
                'game_id' => $faker->randomElement($gameIds),
                'title' => $faker->sentence(6),
                'content' => $faker->paragraphs(5, true),
                'banner_url' => $faker->imageUrl(1200, 400, 'games'),
                'download_link' => $faker->url(),
                'release_server_time' => $faker->dateTimeBetween('now', '+1 month'),
                'created_at' => $faker->dateTimeBetween('-1 month', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 week', 'now')
            ]);
        }
    }
}