<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->string('shipping_code');
            $table->string('name')->nullable()->default('');
            $table->string('phone')->nullable()->default('');
            $table->string('email')->nullable()->default('');
            $table->string('ship_from')->nullable()->default('');
            $table->string('ship_to')->nullable()->default('');
            $table->float('weight')->nullable()->default(0);
            $table->float('height')->nullable()->default(0);
            $table->unsignedBigInteger('delivery_status_id')->nullable();
            $table->foreign('delivery_status_id')->references('id')->on('delivery_status');
            $table->unsignedBigInteger('sub_delivery_status_id')->nullable();
            $table->foreign('sub_delivery_status_id')->references('id')->on('sub_status_deliveries');
            $table->integer('latest_change_status')->nullable();
            $table->dateTime('lastest_checkpoint_time')->nullable();
            $table->string('note')->nullable()->default('');
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
        Schema::dropIfExists('shippings');
    }
}
