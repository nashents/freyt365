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
        $countries = [
            ['name' => 'Zimbabwe', 'flag'=>'zim.png'],
            ['name' => 'Zambia', 'flag'=>'zambia.png'],
            ['name' => 'Botswana', 'flag'=>'botswana.png'],
            ['name' => 'South Africa', 'flag'=>'rsa.png'],
            ['name' => 'Namibia', 'flag'=>'namibia.png'],
            ['name' => 'Mozambique', 'flag'=>'mozambique.png'],
            ['name' => 'Malawai', 'flag'=>'malawi.png'],
            ['name' => 'Democratic Republic of Congo (DRC)', 'flag'=>'drc.png'],
            ['name' => 'Tanzania', 'flag'=>'tanzania.png'],
            ['name' => 'Angola', 'flag'=>'angola.png'],
            ['name' => 'Lesotho', 'flag'=>'lesotho.png'],
            ['name' => 'Eswatini', 'flag'=>'eswatini.png'],
            ];
            Country::insert($countries);
    }
}
