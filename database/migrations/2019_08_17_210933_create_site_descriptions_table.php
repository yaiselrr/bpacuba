<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_descriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->mediumText('home_text')->nullable();
            $table->mediumText('descripcion');
            $table->enum('tipo', ['generales', 'descargas',
                                'redes-oficinas',
                                'cajeros','productos-servicios']);
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
        Schema::dropIfExists('site_descriptions');
    }
}
