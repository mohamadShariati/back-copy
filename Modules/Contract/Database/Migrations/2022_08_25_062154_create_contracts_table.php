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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained('customers');
            $table->string('mobile')->unique()->nullable();
            $table->timestamp('contract_date')->nullable();
            $table->string('cuntruct_subject')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->timestamp('notification_date')->nullable();
            $table->string('payment_period')->nullable();
            $table->decimal('amount', 20, 3);
            $table->text('description')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->comment('which user sign this contract');
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
        Schema::dropIfExists('contracts');
    }
};
