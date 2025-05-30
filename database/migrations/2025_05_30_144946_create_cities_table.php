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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->string('image_url')->nullable();
            $table->mediumText('description')->nullable();
            $table->boolean('is_active')->nullable()->default(true);
            $table->boolean('is_capital')->nullable()->default(true);
            $table->foreignId('region_id')->nullable()->constrained('regions', 'id')->restrictOnUpdate()->restrictOnDelete();
            
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
