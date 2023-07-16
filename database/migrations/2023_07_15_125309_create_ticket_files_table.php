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
        Schema::create('ticket_files', function (Blueprint $table) {
            $table->id();
            $table->text('file_path')->nullable();
            $table->bigInteger('file_size')->nullable();
            $table->string('file_type')->nullable();
            $table->foreignId('ticket_id')->constrained('tickets')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('ticket_files');
    }
};
