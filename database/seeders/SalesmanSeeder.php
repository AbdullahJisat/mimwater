<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Str;

class SalesmanSeeder extends Seeder
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
            DB::table('salesmen')->insert([
                'name' => 'salesman',
                'email' => 'salesman@admin.com',
                'username' => 'salesman',
                'email_verified_at' => now(),
                'password' => bcrypt('salesman'),
                'status' => 1,
                'remember_token' => Str::random(10),
                'phone' => '01645567',
                'location' => 'dhaka',
                'nid' => '3434343',
            ]);
        });
    }
}
