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
        Schema::create('category_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('category_attribute_id')->constrained('category_attributes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('value');
            $table->tinyInteger('type')->default(0)->comment('value type is 0 => single select values , 1 => multi select value (affected on price)');
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
        Schema::dropIfExists('category_values');
    }
};
