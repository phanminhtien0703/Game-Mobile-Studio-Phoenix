<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class GiftcodeSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('vi_VN');
        $gameIds = DB::table('games')->pluck('game_id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            $total_quantity = $faker->numberBetween(100, 1000);
            $used_quantity = $faker->numberBetween(0, $total_quantity);

            DB::table('giftcode')->insert([
                'game_id' => $faker->randomElement($gameIds),
                'giftcode_name' => strtoupper($faker->bothify('??##??##')),
                'total_quantity' => $total_quantity,
                'used_quantity' => $used_quantity,
                'logo_game_url' => $faker->imageUrl(100, 100, 'games'),
                'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 month', 'now')
            ]);
        }
    }
}