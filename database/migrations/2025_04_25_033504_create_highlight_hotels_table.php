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
        Schema::create('highlight_hotels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('highlight_id')->constrained('highlights', 'id')->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('hotel_id')->constrained('hotels', 'id')->restrictOnUpdate()->restrictOnDelete();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('highlight_hotels');
    }
};
