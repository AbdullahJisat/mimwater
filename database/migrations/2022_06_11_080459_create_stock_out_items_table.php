<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_out_items', function (Blueprint $table) {
            $table->id();
            $table->integer('item_id')->unsigned()->nullable();
            $table->integer('retailer_id')->unsigned()->nullable();
            $table->integer('dealer_id')->unsigned()->nullable();
            $table->integer('quantity')->unsigned()->nullable();
            $table->decimal('price')->nullable();
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
        Schema::dropIfExists('stock_out_items');
    }
};
