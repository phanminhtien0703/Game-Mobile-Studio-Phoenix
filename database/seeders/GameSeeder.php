<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class GameSeeder extends Seeder
{
    public function run()
    {
        $games = [
            [
                'game_id' => $gameId = (string) Str::uuid(),
                'game_name' => 'Candy Crush Saga',
                'genre' => 'Puzzle',
                'description' => 'A sweet and colorful puzzle game where players match candies to progress through levels',
                'release_date' => '2023-01-15',
                'avatar_url' => 'https://play-lh.googleusercontent.com/TLUeXHhygYP5j7RK1f4HBUjJ0G0AIjIBWtc5_K8WwNL_nearly6KDELYgPKBQzK5Gg=w240-h480-rw',
                'banner_url' => 'https://cdn.jim-nielsen.com/ios/512/candy-crush-saga-2012-12-05.png',
                'download_link' => 'https://play.google.com/store/apps/details?id=com.king.candycrushsaga',
                'status_id' => 'game_hot',
                'last_updated' => Carbon::now(),
            ],
            [
                'game_id' => $gameId = (string) Str::uuid(),
                'game_name' => 'PUBG Mobile',
                'genre' => 'Battle Royale',
                'description' => 'A multiplayer battle royale game where 100 players fight to be the last one standing',
                'release_date' => '2023-02-20',
                'avatar_url' => 'https://play-lh.googleusercontent.com/JRd05pyBH41qjgsJuWduRJpDeZG0Hnb0yjf2nWqO7VaGKL10-G5UIygxED-WNOc3pg',
                'banner_url' => 'https://cdn1.epicgames.com/spt-assets/767a8a80652c4a108fa5e74c15b62e07/pubg-battlegrounds-1l6ro.png',
                'download_link' => 'https://play.google.com/store/apps/details?id=com.tencent.ig',
                'status_id' => 'game_hot',
                'last_updated' => Carbon::now(),
            ],
            [
                'game_id' => $gameId = (string) Str::uuid(),
                'game_name' => 'Minecraft',
                'genre' => 'Sandbox',
                'description' => 'A creative building game where players can construct anything they imagine',
                'release_date' => '2023-03-10',
                'avatar_url' => 'https://play-lh.googleusercontent.com/VSwHQjcAttxsLE47RuS4PqpC4LT7lCoSjE7Hx5AW_yCxtDvcnsHHvm5CTuL5BPN-uRTP',
                'banner_url' => 'https://www.minecraft.net/content/dam/games/minecraft/key-art/SUPM_Game-Image_One-Vanilla_672x400.jpg',
                'download_link' => 'https://play.google.com/store/apps/details?id=com.mojang.minecraftpe',
                'status_id' => 'game_hot',
                'last_updated' => Carbon::now(),
            ],
            [
                'game_id' => $gameId = (string) Str::uuid(),
                'game_name' => 'Subway Surfers',
                'genre' => 'Runner',
                'description' => 'An endless runner game where players dodge trains and collect coins',
                'release_date' => '2023-04-05',
                'avatar_url' => 'https://play-lh.googleusercontent.com/SxLslhOv5pQ5k3GhrkBm3O9PasqXBqpZHFzm-P3vB5Iq_iPR3RjFsXlAYq7k_L5R6w',
                'banner_url' => 'https://www.kibrispdr.org/data/1744/subway-surfers-banner-27.jpg',
                'download_link' => 'https://play.google.com/store/apps/details?id=com.kiloo.subwaysurf',
                'status_id' => 'game_hot',
                'last_updated' => Carbon::now(),
            ],
            [
                'game_id' => $gameId = (string) Str::uuid(),
                'game_name' => 'Genshin Impact',
                'genre' => 'RPG',
                'description' => 'An open-world action RPG with beautiful anime-style graphics',
                'release_date' => '2023-05-01',
                'avatar_url' => 'https://play-lh.googleusercontent.com/So91qs_eRRralMxUzt_ejKcZqpr4Ah6y4i_yw8Kc_2EZ2R_56dQJCfFsXL4HfZsRuHo',
                'banner_url' => 'https://genshin.hoyoverse.com/_nuxt/img/9a42795.jpg',
                'download_link' => 'https://play.google.com/store/apps/details?id=com.miHoYo.GenshinImpact',
                'status_id' => 'game_hot',
                'last_updated' => Carbon::now(),
            ],
        ];

        foreach ($games as $game) {
            DB::table('games')->insert($game);
        }

        $faker = Faker::create('vi_VN');

        $genres = ['Action', 'Adventure', 'RPG', 'Strategy', 'Simulation'];
        $statusIds = DB::table('game_status')->pluck('status_id')->toArray();

        for ($i = 0; $i < 5; $i++) {
            DB::table('games')->insert([
                'game_id' => $faker->regexify('[A-Za-z0-9]{10}'),
                'game_name' => $faker->unique()->words(3, true),
                'genre' => $faker->randomElement($genres),
                'description' => $faker->paragraph(3),
                'release_date' => $faker->dateTimeBetween('-2 years', 'now'),
                'avatar_url' => $faker->imageUrl(200, 200, 'games'),
                'banner_url' => $faker->imageUrl(1200, 400, 'games'),
                'download_link' => $faker->url(),
                'status_id' => $faker->randomElement($statusIds),
                'last_updated' => $faker->dateTimeBetween('-1 month', 'now')
            ]);
        }
    }
}