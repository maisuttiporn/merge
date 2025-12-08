<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckindescsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkindescs', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('lname');
            $table->string('homenumber');
            $table->integer('amount')->default(0);
            $table->integer('paid')->default(0); // จำนวนเงินที่จ่าย
            
            $table->string('paidstat')->default('0'); // 0 ยังไม่เคลียร์

            $table->string('check')->default('0');


            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('checkin_id');
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
        Schema::dropIfExists('checkindescs');
    }
}
