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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->nullable();
            $table->integer('retailer_id')->unsigned()->nullable();
            $table->integer('dealer_id')->unsigned()->nullable();
            $table->integer('salesman_id')->unsigned()->nullable();
            $table->integer('admin_id')->unsigned()->nullable();
            $table->text('item_id')->nullable();
            $table->decimal('amount')->nullable();
            $table->decimal('due')->nullable();
            $table->tinyInteger('payment_type')->unsigned()->nullable()->comment('1-cash,2-check,3-mobile');
            $table->tinyInteger('payment_status')->unsigned()->nullable()->comment('1-success,2-failed,3-due,4-partial due');
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
        Schema::dropIfExists('payments');
    }
};
