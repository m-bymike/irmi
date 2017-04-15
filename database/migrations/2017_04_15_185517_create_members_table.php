<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->references('user');
            $table->integer('irma_id')->unique();
            $table->text('last_name')->nullable();
            $table->text('first_name')->nullable();

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
        \Schema::dropIfExists('members');
    }
}
