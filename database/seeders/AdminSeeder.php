<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('vi_VN');
        $roles = ['super_admin', 'admin', 'moderator', 'editor'];
        
        // Tạo một super admin cố định
        DB::table('admins')->insert([
            'username' => 'superadmin',
            'email' => 'superadmin@gamemobilestudio.com',
            'password_hash' => Hash::make('admin123'),
            'role' => 'super_admin',
            'created_at' => now(),
            'last_login' => now(),
            'last_activity' => now(),
            'last_ip' => $faker->ipv4()
        ]);

        // Tạo thêm 9 admin khác
        for ($i = 0; $i < 9; $i++) {
            DB::table('admins')->insert([
                'username' => $faker->unique()->userName(),
                'email' => $faker->unique()->companyEmail(),
                'password_hash' => Hash::make('admin123'),
                'role' => $faker->randomElement($roles),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'last_login' => $faker->dateTimeBetween('-1 month', 'now'),
                'last_activity' => $faker->dateTimeBetween('-1 week', 'now'),
                'last_ip' => $faker->ipv4()
            ]);
        }
    }
}