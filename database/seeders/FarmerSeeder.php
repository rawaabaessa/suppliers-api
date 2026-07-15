<?php

namespace Database\Seeders;

use App\Models\Farmer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FarmerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Farmer::insert([
            [
                'user_id' => 1,
                'farm_name' => 'Green Farm',
                'phone' => '0500000001',
                'identity_number' => 'farmer/lices.png',
                'license' => 'farmer/license1.pdf',
                'city' => 'Jeddah',
                'neighborhood' => 'Al Rawdah',
                'street' => 'Street 1',
                'status' => 'approved',
            ],
            [
                'user_id' => 2,
                'farm_name' => 'Fresh Farm',
                'phone' => '0500000002',
                'identity_number' => 'farmer/lices.png',
                'license' => 'farmer/license2.pdf',
                'city' => 'Makkah',
                'neighborhood' => 'Al Aziziyah',
                'street' => 'Street 2',
                'status' => 'approved',
            ],
            [
                'user_id' => 3,
                'farm_name' => 'Organic Farm',
                'phone' => '0500000003',
                'identity_number' => 'farmer/lices.png',
                'license' => 'farmer/license3.pdf',
                'city' => 'Taif',
                'neighborhood' => 'Al Faisaliyah',
                'street' => 'Street 3',
                'status' => 'approved',
            ],
        ]);
    }
}
