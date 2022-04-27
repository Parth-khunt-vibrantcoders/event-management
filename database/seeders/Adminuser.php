<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Hash;
class Adminuser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => "Admin",
            'last_name' => "Admin",
            'full_name' => "Admin Admin",
            'email' => "admin@master.com",
            'password' => Hash::make('Master@2021'),
            'email_verified_at' => date('Y-m-d H:i:s'),
            'userimage' => 'default.png',
            'user_type' => 1,
            'status' => 'A',
            'is_deleted' => 'N',
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
        ]);
    }
}
