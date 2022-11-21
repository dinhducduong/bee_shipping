<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubStatusDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_status_deliveries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('delivery_status_id');
            $table->foreign('delivery_status_id')->references('id')->on('delivery_status');
            $table->string('name');
            $table->string('description_sub_status');
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
        Schema::dropIfExists('sub_status_deliveries');
    }
}
