<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ship_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ship_id');
            $table->string('name');
            $table->string('code');
            $table->integer('quantity');
            $table->decimal('price', 15)->nullable()->default(0);
            $table->foreign('ship_id')->references('id')->on('shippings');
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
        Schema::dropIfExists('ship_details');
    }
}
