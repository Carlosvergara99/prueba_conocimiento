<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha');  
            $table->bigInteger('id_restaurantes')->unsigned();
            $table->string('numero_reservas');
            $table->timestamps();
            $table->foreign('id_restaurantes')->references('id')->on('restaurantes')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservars');
    }
}
