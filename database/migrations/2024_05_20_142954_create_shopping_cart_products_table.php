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
        Schema::create('shopping_cart_products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('shopping_cart_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id');
            $table->foreignId('size_id');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopping_cart_products');
    }
};
