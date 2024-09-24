<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('services_id');
            $table->string('titulo');
            $table->string('slug');
            $table->text('descripcion');
            $table->timestamps();
            $table->string('created_by')->nullable();
            $table->foreign('services_id')
                ->references('id')
                ->on('services')
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
        Schema::dropIfExists('services_pages');
    }
}
