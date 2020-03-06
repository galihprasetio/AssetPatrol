<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceRequestHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_request_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_service_request');
            $table->integer('id_user');
            $table->string('activity');
            $table->string('commentar');
            $table->dateTime('activity_date');
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
        Schema::dropIfExists('service_request_history');
    }
}
