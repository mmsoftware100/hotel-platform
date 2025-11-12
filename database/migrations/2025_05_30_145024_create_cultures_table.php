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
        Schema::create('cultures', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->string('image_url')->nullable();
            $table->mediumText('description')->nullable();
            $table->boolean('is_active')->nullable()->default(true);
            $table->boolean('is_featured')->nullable()->default(true);



            $table->string('google_map_label')->nullable();
            $table->string('google_map_link')->nullable();

            $table->foreignId('destination_id')->nullable()->constrained('destinations', 'id')->restrictOnUpdate()->restrictOnDelete();

            $table->foreignId('division_id')->nullable()->constrained('divisions', 'id')->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('region_id')->nullable()->constrained('regions', 'id')->restrictOnUpdate()->restrictOnDelete();
            // $table->foreignId('city_id')->nullable()->constrained('cities', 'id')->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('district_id')->nullable()->constrained('districts', 'id')->restrictOnUpdate()->restrictOnDelete();
            
            $table->foreignId('township_id')->nullable()->constrained('townships', 'id')->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('village_id')->nullable()->constrained('villages', 'id')->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('culture_category_id')->nullable()->constrained('culture_categories', 'id')->restrictOnUpdate()->restrictOnDelete();
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
        Schema::dropIfExists('cultures');
    }
};
