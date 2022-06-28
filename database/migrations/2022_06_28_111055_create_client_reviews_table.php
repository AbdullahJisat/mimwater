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
        Schema::create('client_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('client_name')->nullable();
            $table->integer('designation_id')->nullable();
            $table->string('image')->nullable();
            $table->string('company_name')->nullable();
            $table->text('review')->nullable();
            $table->integer('status')->nullable()->default(1)->comment('1-active,2-inactive');
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
        Schema::dropIfExists('client_reviews');
    }
};
