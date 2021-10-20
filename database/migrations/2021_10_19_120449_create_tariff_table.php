<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTariffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tariff', function (Blueprint $table) {
            $table->id(); 
            $table->Integer('channel_id'); 
            $table->Integer('classes_id'); 
            $table->Date('from_date'); 
            $table->Date('to_date'); 
            $table->tinyInteger('box_type_id');  // 1 until 20 
            $table->Decimal('price',20); 
            $table->Integer('user_id'); 
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
        Schema::dropIfExists('tariff');
    }
}


