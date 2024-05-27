<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = ['Banking', 'Border Payments', 'Border Post Office','Insurance', 'Road Tolls', 'Truck Yard', 'Filling Station', 'Weigh Bridge', 'Parking'];
        foreach($services as $service){
            Service::create([
                'name' => $service
            ]);
        }
    }
}
