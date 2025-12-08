<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkins', function (Blueprint $table) {
            $table->id();
            $table->string('checkin_desc');
            $table->dateTime('checkin_date')->nullable();
            $table->string('checkin_payment')->default('0'); // 0 = ไม่จ่าย 1 = จ่าย
            $table->string('checkin_itemdesc')->nullable();
            $table->integer('checkin_total')->default('0');
            $table->integer('checkin_member')->default('0'); // คนเข้าร่วม
            
            $table->string('checkin_win')->default('0'); // 0 = ไม่ชนะ 1 = ชนะ
            $table->string('checkin_payer')->nullable();
            $table->integer('checkin_payerid')->default('0');

            $table->string('checkin_lock')->default('0');
            

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
        Schema::dropIfExists('checkins');
    }
}
