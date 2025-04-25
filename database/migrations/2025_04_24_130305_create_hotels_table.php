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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('description')->nullable();
            $table->boolean('active')->nullable();
            $table->double('pricing')->nullable();
            $table->double('lat')->default(0);
            $table->double('lng')->default(0);
            $table->string('google_map_label')->nullable();
            $table->string('google_map_link')->nullable();
            $table->foreignId('township_id')->nullable()->constrained('townships', 'id')->restrictOnUpdate()->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
