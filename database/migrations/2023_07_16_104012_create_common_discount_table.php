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
        Schema::create('common_discount', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('persentage')->default(0);
            $table->unsignedBigInteger('discount_ceiling')->nullable();
            $table->unsignedBigInteger('minimal_order_amount')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0 => unactive, 1 => active');
            $table->timestamp('start_date')->useCurrent();
            $table->timestamp('end_date')->useCurrent();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('common_discount');
    }
};
