<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('aircraft_id')->unsigned();
            $table->integer('member_id')->nullable()->unsigned();
            $table->integer('type')->unsigned();
            $table->timestamp('start');
            $table->timestamp('end');
            $table->text('remarks')->nullable();
            $table->integer('irma_id')->unsigned()->nullable();
            $table->timestamp('irma_created')->nullable();

            $table->foreign('aircraft_id')
                ->references('id')
                ->on('aircrafts')
                ->onDelete('restrict');

            $table->foreign('member_id')
                ->references('id')
                ->on('members')
                ->onDelete('restrict');

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
        Schema::dropIfExists('reservations');
    }
}
