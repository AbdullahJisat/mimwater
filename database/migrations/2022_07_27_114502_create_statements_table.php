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
        Schema::create('statements', function (Blueprint $table) {
            $table->id();
            $table->string('from_date')->nullable();
            $table->string('to_date')->nullable();
            $table->integer('retailer_id')->nullable();
            $table->integer('dealer_id')->nullable();
            $table->integer('salesman_id')->nullable();
            $table->integer('admin_id')->nullable();
            $table->integer('in')->nullable();
            $table->integer('out')->nullable();
            $table->integer('stock')->nullable();
            $table->decimal('rate')->nullable();
            $table->decimal('bill')->nullable();
            $table->decimal('payment')->nullable();
            $table->decimal('dues')->nullable();
            $table->decimal('discount')->nullable();
            $table->decimal('total')->nullable();
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
        Schema::dropIfExists('statements');
    }
};
