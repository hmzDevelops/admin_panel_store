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
        Schema::create('product_colors', function (Blueprint $table) {
            $table->id();
            $table->string('color_name');
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('price_increase',20,3)->default(0);
            $table->tinyInteger('status')->default(0)->comment('0 => unactive, 1 => active');
            $table->tinyInteger('sold_number')->default(0)->comment('0 => unsold, 1 => sold');
            $table->tinyInteger('frozen_number')->default(0)->comment('0 => frozen, 1 => unfrozen');
            $table->tinyInteger('marketable_number')->default(0)->comment('0 => unmarketable, 1 => marketable');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_colors');
    }
};
