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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_status_id')->constrained('booking_statuses', 'id')->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('hotel_room_type_id')->constrained('hotel_room_types', 'id')->restrictOnUpdate()->restrictOnDelete();
            $table->date('check_in_date')->default(now());
            $table->date('check_out_date')->default(now()->addDays(value: 1));
            $table->double('total_price')->default(0);
            $table->integer('number_of_guests')->default(0);
            // ဘာေကြာင့်မို့ ဒီေလာက် ကျပါတယ် ဆိုတာ ဘယ်လိုေပြာမလဲ? 
            // season နှစ်ခု ၊​ pricing နှစ်ခု ကြား ေရာက်သွားရင် ခက်မယ်။​
            // check in date ကို ကြည့်မယ်။

            // guest info
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('zip')->nullable();
            $table->string('country_code')->nullable();
            $table->string('passport_no')->nullable();
            $table->string('passport_expiry_date')->nullable();
            $table->string('passport_country')->nullable();
            $table->string('passport_city')->nullable();
            $table->string('passport_state')->nullable();
            $table->string('passport_zip')->nullable();
            $table->string('passport_address')->nullable();
            $table->string('passport_country_code')->nullable();
            $table->string('passport_phone')->nullable();
            $table->string('passport_email')->nullable();
            $table->string('passport_first_name')->nullable();
            $table->string('passport_last_name')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
