<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TypesRepair extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TypesRepair', function (Blueprint $table) {
            $table->id('id_type');
            $table->string('name');
            $table->string('description');
            $table->string('price');
            $table->string('addit_info_one')->nullable();
            $table->string('addit_info_two');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TypesRepair');
    }
}
