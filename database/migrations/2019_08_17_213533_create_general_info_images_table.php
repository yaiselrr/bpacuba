<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralInfoImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_info_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('info_id');
            $table->string('nombre');
            $table->string('imagen');
            $table->timestamps();
            $table->foreign('info_id')
                ->references('id')
                ->on('general_info')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_info_images');
    }
}
