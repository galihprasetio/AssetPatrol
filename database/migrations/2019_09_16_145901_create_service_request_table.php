<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_request', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('doc_number')->nullable();
            $table->integer('id_department')->nullable();
            $table->integer('id_requestor')->nullable();
            $table->dateTime('submit_date')->nullable();
            $table->string('doc_status')->nullable();
            $table->integer('id_author')->nullable();
            $table->string('subject')->nullable();
            $table->text('description')->nullable();
            $table->integer('id_approver1')->nullable();
            $table->dateTime('date_approver1')->nullable();
            $table->integer('id_approver2')->nullable();
            $table->dateTime('date_approver2')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_request');
    }
}
