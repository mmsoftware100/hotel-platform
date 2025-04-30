<?php

namespace Database\Seeders;

use App\Models\BookingStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BookingStatus::create(['id'=>1, 'name' => 'Pending']);
        BookingStatus::create(['id'=>2, 'name' => 'Cancelled']);
        BookingStatus::create(['id'=>3, 'name' => 'Confirmed']);
        BookingStatus::create(['id'=>4, 'name' => 'Checked In']);
        BookingStatus::create(['id'=>5, 'name' => 'Checked Out']);
    }
}
