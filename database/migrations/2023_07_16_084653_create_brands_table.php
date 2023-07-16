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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('persian_name');
            $table->string('orginal_name');
            $table->string('slug')->unique()->nullable();
            $table->text('logo')->comment('logo is required');
            $table->tinyInteger('status')->default(0)->comment('0 => unactive, 1 => active');
            $table->text('tags');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
