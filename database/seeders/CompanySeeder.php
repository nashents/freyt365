<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallet;
use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function generatePIN($digits = 4){
        $i = 0; //counter
        $pin = ""; //our default pin is blank.
        while($i < $digits){
            //generate a random number between 0 and 9.
            $pin .= mt_rand(0, 9);
            $i++;
        }
        return $pin;
    }

    public function run()
    {
        $password = Hash::make('admin12345');

        $user = User::create([
            'name' => 'Raysun Capital',
            'category' => 'company',
            'email' => 'enquires@raysuncapital.com',
            'password' => $password,
        ]);
     
        $company = new Company;

        $company->user_id = $user->id;
        $company->type = "Admin";
        $company->name = "Raysun Capital";
        $company->email = "enquires@raysuncapital.com";
        $company->noreply = "noreply@gonyetitls.co.zw";
        $company->phonenumber = "0782421799";
        $company->country = "Zimbabwe";
        $company->city = "Harare";
        $company->suburb = "Eastlea";
        $company->street_address = "20 Ray Amm Rd";
        $company->save();



    }
}
