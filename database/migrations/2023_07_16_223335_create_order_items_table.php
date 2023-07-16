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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products')->cascadeOnUpdate()->cascadeOnDelete();
            $table->longText('product');
            $table->foreignId('amazing_sale_id')->nullable()->constrained('products')->cascadeOnUpdate()->cascadeOnDelete();
            $table->longText('amazing_sale_object');
            $table->decimal('amazing_sale_discount_amount',20 , 3);
            $table->integer('number')->default(1)->comment('order count');
            $table->decimal('final_product_price',20 , 3)->nullable();
            $table->decimal('final_total_price',20 , 3)->nullable()->comment('number * final_product_price');
            $table->foreignId('color_id')->nullable()->constrained('product_colors')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('guarantee_id')->nullable()->constrained('guarantees')->cascadeOnUpdate()->cascadeOnDelete();
            $table->tinyInteger('status')->default(0)->comment('0 => unactive, 1 => active');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
