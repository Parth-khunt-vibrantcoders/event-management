<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class Usertype extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_type')->insert([
            'user_role' => "Super Admin",
            'status' => 1,
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
        ]);
    }
}
