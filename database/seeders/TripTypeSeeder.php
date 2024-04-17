<?php

namespace Database\Seeders;

use App\Models\TripType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TripTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trip_types = ['Local','Cross Border', 'Return', 'Intransit' , 'Inward' , 'Outward'];
        foreach($trip_types as $trip_type){
            TripType::create([
                'name' => $trip_type
            ]);
        }
    }
}
