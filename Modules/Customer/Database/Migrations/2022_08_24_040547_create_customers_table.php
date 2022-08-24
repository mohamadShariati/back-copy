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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('agent')->nullable();
            $table->tinyInteger('real_or_legal')->default(0)->comment('0 => real, 1 => legal');
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->text('address');
            $table->string('mobile')->unique()->nullable();
            $table->string('tel')->nullable();
            $table->string('manager_name')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->comment('which user created this company');
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
        Schema::dropIfExists('customers');
    }
};
