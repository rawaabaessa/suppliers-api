<?php

namespace Database\Seeders;

use App\Models\FarmDeliverySlot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FarmDeliverySlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $farmers = [1, 2, 3];
        $slots = [1, 2, 3];


        foreach ($farmers as $farmer) {
            foreach ($slots as $slot) {

                FarmDeliverySlot::create([
                    'farmer_id' => $farmer,
                    'delivery_slot_id' => $slot,
                ]);

            }
        }
    }
}
