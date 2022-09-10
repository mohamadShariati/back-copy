<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamp('request_date')->nullable();
            $table->foreignId('base_product_id')->constrained('base_products')->onUpdate('cascade')->onDelete('cascade');
            $table->text('subject')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('priority')->default(0)->comment('0 => low, 1 => medium, 2 => high');
            $table->tinyInteger('status')->default(0);
            $table->foreignId('complete_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamp('complete_date')->nullable();
            $table->foreignId('create_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('update_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
};
