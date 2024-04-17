<?php

namespace Database\Seeders;

use App\Models\Measurement;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MeasurementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $measurements = [
            ['cargo_type' => 'Solid', 'name' => 'Bags'],
            ['cargo_type' => 'Solid','name' => 'Bulk'],
            ['cargo_type' => 'Solid','name' => 'Cartons'],
            ['cargo_type' => 'Solid','name' => 'Containers'],
            ['cargo_type' => 'Liquid','name' => 'Litres'],
            ['cargo_type' => 'Solid','name' => 'Units'],
            ['cargo_type' => 'Solid','name' => 'Trailers'],
        ];
       
            Measurement::insert($measurements);
    }
}
