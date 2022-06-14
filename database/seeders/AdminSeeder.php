<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function()
        {
            DB::table('admins')->insert([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'username' => 'admin',
                'email_verified_at' => now(),
                'password' => bcrypt('mimwater'),
                'remember_token' => Str::random(10),
            ]);
        });
    }
}
