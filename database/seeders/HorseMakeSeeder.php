<?php

namespace Database\Seeders;

use App\Models\HorseMake;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HorseMakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $horse_makes = ['Freightliner', 'Mercedes', 'Volvo', 'Shacman','Man', 'Iveco', 'Foton','Scania'];
        foreach($horse_makes as $horse_make){
            HorseMake::create([
                'user_id' => 1,
                'name' => $horse_make
            ]);
        }
    }
}
