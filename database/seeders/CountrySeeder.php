<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = ['Zimbabwe', 'South Africa', 'Mozambique', 'Botswana', 'Malawi', 'Zambia','DRC','Tanzania'];
        foreach($countries as $country){
            Country::create([
                'name' => $country
            ]);
        }
    }
}
