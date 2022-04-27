<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class SystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('system_setting')->insert([
                'system_name' =>'Event Management System',
                'website_keywords' =>'Event Management System' ,
                'author_name' =>'Event Management System' ,
                'date_formate' =>'1',
                'decimal_point' => '2',
                'footer_text' =>'Event Management System',
                'footer_link' => 'javascrip:;',
                'website_description' =>'Event Management System',
                'website_logo' =>'default.png',
                'favicon_icon' => 'default.png',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
