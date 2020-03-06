<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('software_name');
            $table->integer('id_category');
            $table->string('product_key');
            $table->integer('seats');
            $table->integer('id_manufacture');
            $table->string('license_name');
            $table->string('license_email');
            $table->integer('id_supplier');
            $table->string('purchase_order');
            $table->integer('purchase_cost');
            $table->date('purchase_date');
            $table->date('expiration_date');
            $table->date('termination_date');
            $table->string('notes');
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
        Schema::dropIfExists('licenses');
    }
}
