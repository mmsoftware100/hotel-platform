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
        Schema::create('transportations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->foreignId('transportation_category_id')->constrained('transportation_categories')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->string('image_url')->nullable();
            $table->mediumText('description')->nullable();
            $table->boolean('is_active')->nullable()->default(true);
            $table->boolean('is_featured')->nullable()->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transportations');
    }
};
