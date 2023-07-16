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
        Schema::create('category_attribute_default_values', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            $table->tinyInteger('status')->default(0)->comment('0 => unactive, 1 => active');
            $table->foreignId('category_attribute_id')->constrained('category_attributes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_attribute_default_values');
    }
};
