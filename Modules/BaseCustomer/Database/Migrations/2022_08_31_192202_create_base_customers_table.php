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
        Schema::create('base_customers', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('agent')->nullable();
            $table->tinyInteger('real_or_legal')->default(0)->comment('0 => real, 1 => legal');
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->text('address');
            $table->string('mobile')->nullable();
            $table->string('tel')->nullable();
            $table->string('manager_name')->nullable();
            $table->foreignId('create_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('base_customers');
    }
};
