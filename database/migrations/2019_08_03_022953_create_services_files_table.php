<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pages_id');
            $table->string('nombre');
            $table->string('fichero');
            $table->timestamps();
            $table->string('created_by')->nullable();
            $table->foreign('pages_id')
                ->references('id')
                ->on('services_pages')
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
        Schema::dropIfExists('services_files');
    }
}
