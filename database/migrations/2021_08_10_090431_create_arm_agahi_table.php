<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArmAgahiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arm_agahi', function (Blueprint $table) {
            $table->id();
            $table->Integer('channel_id');
            $table->double('coef',200,1); // double('coef',3,1);
            $table->Date('from_date');
            $table->Date('to_date');
            $table->bigInteger('user_id');
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
        Schema::dropIfExists('arm_agahi');
    }
}
