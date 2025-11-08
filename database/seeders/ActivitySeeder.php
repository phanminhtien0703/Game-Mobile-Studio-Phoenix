<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ActivitySeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('vi_VN');
        
        $userIds = DB::table('users')->pluck('user_id')->toArray();
        $adminIds = DB::table('admins')->pluck('admin_id')->toArray();
        
        $activityTypes = [
            'login', 'logout', 'profile_update', 'password_change',
            'game_download', 'giftcode_redeem', 'payment'
        ];

        for ($i = 0; $i < 10; $i++) {
            $useAdmin = $faker->boolean(30);
            
            DB::table('activities')->insert([
                'user_id' => $useAdmin ? null : $faker->randomElement($userIds),
                'admin_id' => $useAdmin ? $faker->randomElement($adminIds) : null,
                'session_id' => $faker->uuid(),
                'activity_type' => $faker->randomElement($activityTypes),
                'description' => $faker->sentence(),
                'activity_timestamp' => $faker->dateTimeBetween('-1 month', 'now')
            ]);
        }
    }
}