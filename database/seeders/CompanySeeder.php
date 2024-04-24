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


    public function run()
    {
       
        $company = new Company;
        $company->type = "Admin";
        $company->name = "Raysun Capital";
        $company->email = "enquires@raysuncapital.com";
        $company->noreply = "noreply@gonyetitls.com";
        $company->phonenumber = "0782421799";
        $company->country = "Zimbabwe";
        $company->city = "Harare";
        $company->suburb = "Eastlea";
        $company->street_address = "20 Ray Amm Rd";
        $company->status = 1;
        $company->save();

        $password = Hash::make('admin12345');

        $user = new User;
        $user->company_id = $company->id;
        $user->name = 'Panashe';
        $user->surname = 'Ngorima';
        $user->category = 'admin';
        $user->is_admin = 1;
        $user->use_email_as_username = 1;
        $user->email = 'admin@admin';
        $user->phonenumber = '0782421799';
        $user->username = 'admin@admin';
        $user->password = $password;
        $user->save();
        $user->roles()->attach(1);



    }
}
