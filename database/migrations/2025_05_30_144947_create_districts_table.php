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
        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->string('image_url')->nullable();
            $table->mediumText('description')->nullable();
            $table->boolean('is_active')->nullable()->default(true);
            $table->boolean('is_featured')->nullable()->default(true);
            $table->foreignId('region_id')->nullable()->constrained('regions', 'id')->restrictOnUpdate()->restrictOnDelete();
            $table->boolean('is_state')->nullable()->default(true);

            $table->string('google_map_label')->nullable();
            $table->string('google_map_link')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();               
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('districts');
    }
};
