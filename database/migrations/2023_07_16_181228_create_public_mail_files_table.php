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
        Schema::create('public_mail_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('public_mail_id')->constrained('public_mail')->cascadeOnUpdate()->cascadeOnDelete();
            $table->text('file_path');
            $table->bigInteger('file_size');
            $table->string('file_type');
            $table->tinyInteger('file_location')->default(1)->comment('1 => public_path, 1 => storage_path');
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
        Schema::dropIfExists('public_mail_files');
    }
};
