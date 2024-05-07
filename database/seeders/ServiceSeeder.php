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
        $services = ['Parking', 'Weigh bridge'];
        foreach($services as $service){
            Service::create([
                'name' => $service
            ]);
        }
    }
}
