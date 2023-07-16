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
        Schema::create('delivery', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('amount', 20, 3)->nullable()->comment('if null then delivery free');
            $table->integer('delivery_time');
            $table->string('delivery_time_unit');
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
        Schema::dropIfExists('delivery');
    }
};
