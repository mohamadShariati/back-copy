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
        Schema::create('contract_product', function (Blueprint $table) {
            $table->foreignId('contract_id')->constrained('contracts')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('base_product_id')->constrained('base_products')->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['contract_id', 'base_product_id']);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contract_product');
    }
};
