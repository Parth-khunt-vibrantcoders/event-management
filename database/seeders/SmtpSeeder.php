<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Hash;
class SmtpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('smtp_setting')->insert([
            'server' =>'mail.vibrantcoders.com',
            'username' =>'hr@vibrantcoders.com' ,
            'password' =>('Vibrant@2020'),
            'port' =>'587',
            'driver' => 'smtp',
            'encryption' =>'SSL',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
    ]);
    }
}
