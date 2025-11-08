<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TouristSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('vi_VN');
        
        $activityTypes = [
            'page_view', 'game_view', 'download_attempt', 
            'news_read', 'event_view', 'search'
        ];

        for ($i = 0; $i < 10; $i++) {
            DB::table('tourists')->insert([
                'session_id' => $faker->uuid(),
                'ip_address' => $faker->ipv4(),
                'activity_type' => $faker->randomElement($activityTypes),
                'description' => $faker->sentence(),
                'activity_timestamp' => $faker->dateTimeBetween('-1 month', 'now')
            ]);
        }
    }
}