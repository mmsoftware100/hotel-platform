<?php

namespace Database\Seeders;

use App\Models\Booking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Booking::create([
            'booking_status_id' => 1,
            'hotel_room_type_id' => 1,
            'check_in_date' => now(),
            'check_out_date' => now()->addDays(2),
            'number_of_guests' => 2,
            'total_price' => 100,
            'first_name' => 'John',
        ]);
    }
}
