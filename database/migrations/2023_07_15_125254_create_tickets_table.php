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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('subject')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0 => unactive, 1 => active');
            $table->tinyInteger('seen')->default(0)->comment('0 => unseen, 1 => seen');
            $table->foreignId('reference_id')->constrained('ticket_admins')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('category_id')->constrained('ticket_categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('priority_id')->constrained('ticket_priorities')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('ticket_id')->nullable()->constrained('tickets')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
