<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMinciProducto1StdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('minci_producto1_std', function (Blueprint $table) {
            $table->id();
            $table->string('region');
            $table->string('region_code');
            $table->string('commune');
            $table->string('commune_code');
            $table->string('population');
            $table->date('date');
            $table->string('commit_cases');
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
        Schema::dropIfExists('minci_producto1_std');
    }
}
