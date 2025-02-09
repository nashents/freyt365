<?php

namespace Database\Seeders;

use App\Models\FuelType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FuelTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fuel_types = ['Diesel'];
        foreach($fuel_types as $fuel_type){
            FuelType::create([
                'name' => $fuel_type
            ]);
        }
    }
}
