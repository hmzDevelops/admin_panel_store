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
        Schema::create('copans', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('amount');
            $table->tinyInteger('amount_type')->default(0)->comment('0 => persentage, 1 => price unit');
            $table->unsignedBigInteger('discount_ceiling')->nullable()->comment('maximum discount');
            $table->tinyInteger('type')->default(0)->comment('0 => common(each user can one time), 1 => private (one user can one time)');
            $table->tinyInteger('status')->default(0)->comment('0 => unactive, 1 => active');
            $table->timestamp('start_date')->useCurrent();
            $table->timestamp('end_date')->useCurrent();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('copans');
    }
};
