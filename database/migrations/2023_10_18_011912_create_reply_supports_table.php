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
        Schema::create('replies_support', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('content');
            $table->foreignUuid('user_id')->references('id')->on('users');
            $table->foreignUuid('support_id')->references('id')->on('supports');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replies_support');
    }
};
