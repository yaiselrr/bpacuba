<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBpaValorationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bpa_valorations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('estrellas');
            $table->enum('tipo', ['banca-electronica', 'banca-corporativa','banca-personal','tcp-cna']);
            $table->string('created_by')->nullable();

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
        Schema::dropIfExists('bpa_valorations');
    }
}
