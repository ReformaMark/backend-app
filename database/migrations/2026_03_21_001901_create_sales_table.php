<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->on('products')->onDelete('cascade');
            $table->foreignId('branch_id')->constrained('branches')->on('branches')->onDelete('cascade');
            $table->string('product_name');
            $table->float('product_price');
            $table->integer('total_quantity');
            $table->float('total_amount');
            $table->timestamps();
        });;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
