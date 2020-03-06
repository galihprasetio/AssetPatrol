<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_manufacture');
            $table->string('asset_tag');
            $table->integer('id_category');
            $table->string('serial');
            $table->string('asset_name');
            $table->string('order_number');
            $table->string('warranty');
            $table->integer('qty');
            $table->integer('min_qty');
            $table->string('notes');
            $table->integer('id_location');
            $table->string('image');
            $table->string('created_by');
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
        Schema::dropIfExists('assets');
    }
}
