<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->id();
            $table->string('owner')->unique();
            $table->string('manager_owner')->nullable();
            $table->string('tell_owner')->nullable();
            $table->string('fax_owner')->nullable();
            $table->string('email_owner')->nullable();
            $table->string('address_owner')->nullable();
            $table->tinyInteger('kind_group');
            $table->string('description_owner')->nullable();
            $table->bigInteger ('user_id');
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
        Schema::dropIfExists('owners');
    }
    
}
