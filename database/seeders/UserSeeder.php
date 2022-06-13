<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    //  Just Run One More Time
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'SuperAdmin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
        ]);

        DB::table('role_users')->insert([
            'user_id' => 1,
            'role_id' => 1,
        ]);
    }
}
