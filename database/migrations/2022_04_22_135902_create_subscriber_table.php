<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriber', function (Blueprint $table) {
            $table->id();
            $table->string('subscriber_no');
            $table->string('sr_no')->nullable();
            $table->string('name');
            $table->text('address_1')->nullable();
            $table->text('address_2')->nullable();
            $table->text('address_3')->nullable();
            $table->string('area')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('pincode')->nullable();
            $table->string('contactno')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('landline')->nullable();
            $table->string('email')->nullable();
            $table->string('type')->nullable();
            $table->decimal('price', 8,3)->default(0);
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
        Schema::dropIfExists('subscriber');
    }
}
