<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_setting', function (Blueprint $table) {
            $table->id();
            $table->string('system_name');
            $table->string('website_keywords');
            $table->string('author_name');
            $table->integer('date_formate');
            $table->integer('decimal_point');
            $table->text('footer_text');
            $table->text('footer_link');
            $table->text('website_description');
            $table->string('website_logo');
            $table->string('favicon_icon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_setting');
    }
}
