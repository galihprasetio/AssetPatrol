<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accessories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_manufacture');
            $table->string('accessories_name');
            $table->string('order_number');
            $table->string('warranty');
            $table->integer('qty');
            $table->integer('min_qty');
            $table->text('notes');
            $table->integer('id_locatoin');
            $table->string('image');
            $table->string('created_by');
            $table->timestamps();
            $table->dateTime('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accessories');
    }
}
