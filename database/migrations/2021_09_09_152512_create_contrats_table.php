<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrats', function (Blueprint $table) {
            $table->id();

            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients')->onUpdate('cascade')->onDelete('restrict');

            $table->string('energy');
            $table->string('product');
            $table->string('gsrn');
            $table->integer('duration');
            $table->string('codePromo');
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
        Schema::dropIfExists('contrats');
    }
}
