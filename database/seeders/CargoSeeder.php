<?php

namespace Database\Seeders;

use App\Models\Cargo;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cargos = [
            ['type' => 'Solid', 'name'=>'Maize'],
            ['type' => 'Solid', 'Wheat'],
            ['type' => 'Solid', 'name'=> 'Sorghum'],
            ['type' => 'Solid','name'=> 'Barley'],
            ['type' => 'Solid', 'name'=> 'Granite'],
            ['type' => 'Solid', 'name'=> 'Lime'],
            ['type' => 'Liquid', 'name'=> 'Petrol'],
            ['type' => 'Liquid', 'name'=> 'Diesel'],
            ['type' => 'Solid', 'name'=> 'Compound D'],
            ['type' => 'Solid', 'name'=> 'Ammonium Nitrate'],
            ['type' => 'Solid', 'name'=> 'MAP'],
            ['type' => 'Solid', 'name'=> 'MOP'],
            ['type' => 'Solid', 'name'=> 'Cement'],
            ['type' => 'Solid', 'name'=> 'Timber'],
            ['type' => 'Solid', 'name'=>'Sulphur'],
            ['type' => 'Solid', 'name'=>'Chrome'],
            ['type' => 'Solid', 'name'=>'Steel'],
            ['type' => 'Solid', 'name'=>'Container'],
            ];
            Cargo::insert($cargos);
    }
}
