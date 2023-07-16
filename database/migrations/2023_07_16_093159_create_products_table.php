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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('introduction');
            $table->string('slug')->unique()->nullable();
            $table->text('image')->nullable();
            $table->decimal('weight',10,2)->nullable();
            $table->decimal('length',10,1)->nullable()->comment('cm unit');
            $table->decimal('width',10,1)->nullable()->comment('cm unit');
            $table->decimal('height',10,1)->nullable()->comment('cm unit');
            $table->decimal('price',20,3)->nullable();
            $table->tinyInteger('status')->default(0)->comment('0 => unactive, 1 => active');
            $table->tinyInteger('marketable')->default(1)->comment('1 => marketable, 0 => unmarketable');
            $table->text('tags');
            $table->tinyInteger('sold_number')->default(0)->comment('0 => unsold, 1 => sold');
            $table->tinyInteger('frozen_number')->default(0)->comment('0 => frozen, 1 => unfrozen');
            $table->tinyInteger('marketable_number')->default(0)->comment('0 => unmarketable, 1 => marketable');
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('category_id')->constrained('product_categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamp('published_at')->comment('product release date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
