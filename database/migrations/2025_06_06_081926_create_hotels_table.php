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
            $table->string('name')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->string('address')->nullable();
            $table->text('description')->nullable();
            $table->boolean('active')->default(true);
            $table->decimal('pricing', 8, 2)->default(0.00);
            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lng', 10, 7)->nullable();
            $table->string('google_map_label')->nullable();
            $table->string('google_map_link')->nullable();
            // $table->foreignId('township_id')->constrained()->onDelete('cascade');
            $table->string('image_url')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);



            $table->foreignId('destination_id')->nullable()->constrained('destinations', 'id')->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('division_id')->nullable()->constrained('divisions', 'id')->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('region_id')->nullable()->constrained('regions', 'id')->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('city_id')->nullable()->constrained('cities', 'id')->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('township_id')->nullable()->constrained('townships', 'id')->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('village_id')->nullable()->constrained('villages', 'id')->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('hotel_category_id')->nullable()->constrained('hotel_categories', 'id')->restrictOnUpdate()->restrictOnDelete();
            $table->softDeletes();



            $table->timestamps();
        });

        // 'name' => 'Sunrise Palace Hotel',
        //         'address' => '123 Seaside Rd, Hlaing',
        //         'description' => 'A modern hotel with sea view and rooftop pool.',
        //         'active' => true,
        //         'pricing' => 85.50,
        //         'lat' => 16.7982,
        //         'lng' => 96.1570,
        //         'google_map_label' => 'Sunrise Palace',
        //         'google_map_link' => 'https://maps.google.com/?q=Sunrise+Palace+Hotel',
        //         'township_id' => 1, // Ensure this township exists
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
