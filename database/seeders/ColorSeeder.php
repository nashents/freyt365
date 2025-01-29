<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['name' => 'Red', 'hex' => '#FF0000'],
            ['name' => 'Blue', 'hex' => '#0000FF'],
            ['name' => 'Green', 'hex' => '#008000'],
            ['name' => 'Yellow', 'hex' => '#FFFF00'],
            ['name' => 'Black', 'hex' => '#000000'],
            ['name' => 'White', 'hex' => '#FFFFFF'],
            ['name' => 'Orange', 'hex' => '#FFA500'],
            ['name' => 'Purple', 'hex' => '#800080'],
            ['name' => 'Pink', 'hex' => '#FFC0CB'],
            ['name' => 'Gray', 'hex' => '#808080'],
            ['name' => 'Brown', 'hex' => '#A52A2A'],
            ['name' => 'Cyan', 'hex' => '#00FFFF'],
            ['name' => 'Magenta', 'hex' => '#FF00FF'],
            ['name' => 'Lime', 'hex' => '#00FF00'],
            ['name' => 'Indigo', 'hex' => '#4B0082'],
            ['name' => 'Maroon', 'hex' => '#800000'],
            ['name' => 'Olive', 'hex' => '#808000'],
            ['name' => 'Teal', 'hex' => '#008080'],
            ['name' => 'Navy', 'hex' => '#000080']
        ];
            Color::insert($colors);
    }
}
