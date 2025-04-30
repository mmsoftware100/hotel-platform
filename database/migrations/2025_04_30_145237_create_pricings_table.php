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
        Schema::create('pricings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_room_type_id')->constrained('hotel_room_types', 'id')->restrictOnUpdate()->restrictOnDelete();
            $table->double('price')->default(0);
            $table->date('start_date')->default(now());
            $table->date('end_date')->default(now()->addDays(30));
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricings');
    }
};
