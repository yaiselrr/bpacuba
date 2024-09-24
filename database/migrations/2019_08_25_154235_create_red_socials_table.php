<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRedSocialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('red_socials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo');
            $table->string('url');
            $table->unsignedBigInteger('red_social');
            $table->foreign('red_social')
                ->references('id')
                ->on('socials')
                ->onDelete('cascade');
            $table->timestamps();
            $table->string('created_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('red_socials');
    }
}
