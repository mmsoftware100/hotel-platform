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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_room_type_id')->constrained('hotel_room_types', 'id')->restrictOnUpdate()->restrictOnDelete();
            $table->string('name');
            $table->string('room_no');
            $table->boolean('active')->default(true);

            // combine unique index for hotel_room_type_id and room_no
            $table->unique(['hotel_room_type_id', 'room_no'], 'room_unique_index');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
