<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $country = Country::where('name','Zimbabwe')->first();

        $branches = [
            ['country_id' => $country->id,'name' => 'Harare', 'phonenumber'=>'', 'email'=>'', 'city' => '', 'suburb'=>'','street_address' => '','lat' => '', 'long' => '','status' => '1'],
            ['country_id' => $country->id,'name' => 'Mutare Freyt Office', 'phonenumber'=>'', 'email'=>'', 'city' => '', 'suburb'=>'','street_address' => '','lat' => '', 'long' => '','status' => '1'],
            ['country_id' => $country->id,'name' => 'Nyamapanda Freyt Office', 'phonenumber'=>'', 'email'=>'', 'city' => '', 'suburb'=>'','street_address' => '','lat' => '', 'long' => '','status' => '1'],
            ['country_id' => $country->id,'name' => 'Masvingo', 'phonenumber'=>'', 'email'=>'', 'city' => '', 'suburb'=>'','street_address' => '','lat' => '', 'long' => '','status' => '1'],
            ['country_id' => $country->id,'name' => 'Chiredzi', 'phonenumber'=>'', 'email'=>'', 'city' => '', 'suburb'=>'','street_address' => '','lat' => '', 'long' => '','status' => '1'],
            ['country_id' => $country->id,'name' => 'Beitbridge', 'phonenumber'=>'', 'email'=>'', 'city' => '', 'suburb'=>'','street_address' => '','lat' => '', 'long' => '','status' => '1'],
            ['country_id' => $country->id,'name' => 'Bulawayo', 'phonenumber'=>'', 'email'=>'', 'city' => '', 'suburb'=>'','street_address' => '','lat' => '', 'long' => '','status' => '1'],
            ['country_id' => $country->id,'name' => 'Vicfalls', 'phonenumber'=>'', 'email'=>'', 'city' => '', 'suburb'=>'','street_address' => '','lat' => '', 'long' => '','status' => '1'],
            ['country_id' => $country->id,'name' => 'Chirundu', 'phonenumber'=>'', 'email'=>'', 'city' => '', 'suburb'=>'','street_address' => '','lat' => '', 'long' => '','status' => '1'],
            ];
            Branch::insert($branches);
    }
}
