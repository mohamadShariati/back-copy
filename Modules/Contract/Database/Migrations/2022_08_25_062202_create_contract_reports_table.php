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
        Schema::create('contract_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contract_id')->nullable()->constrained('contracts');
            $table->text('description')->nullable();
            $table->string('attribute_name')->unique()->nullable();
            $table->decimal('amount', 20, 3);
            $table->foreignId('create_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamp('send_date')->nullable();
            $table->timestamp('contract_date')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('contract_reports');
    }
};
