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
        Schema::create('room_facility_room_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_facility_id')->constrained('room_facilities', 'id')->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('room_type_id')->constrained('room_types', 'id')->restrictOnUpdate()->restrictOnDelete();
            $table->double('priority')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_facility_room_types');
    }
};
