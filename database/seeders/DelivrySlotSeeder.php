<?php

namespace Database\Seeders;

use App\Models\DeliverySlot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DelivrySlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeliverySlot::insert([
            [
                'name' => 'Morning',
                'start_time' => '08:00:00',
                'end_time' => '12:00:00',
            ],
            [
                'name' => 'Afternoon',
                'start_time' => '12:00:00',
                'end_time' => '16:00:00',
            ],
            [
                'name' => 'Evening',
                'start_time' => '16:00:00',
                'end_time' => '20:00:00',
            ],
        ]);
    }
}
