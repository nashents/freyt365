<?php

namespace Database\Seeders;

use App\Models\VendorType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VendorTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendor_types = ['Secure Parking Facility','Third Party and RTA Insurance', '24 Hour roadside assistance'];
        foreach($vendor_types as $vendor_type){
            VendorType::create([
                'name' => $vendor_type
            ]);
        }
    }
}
