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


     public function companyNumber(){

        $initials = 'F365';

            $company = Company::orderBy('id','desc')->first();

        if (!$company) {
            $company_number =  $initials .'C'. str_pad(1, 5, "0", STR_PAD_LEFT);
        }else {
            $number = $company->id + 1;
            $company_number =  $initials .'C'. str_pad($number, 5, "0", STR_PAD_LEFT);
        }

        return  $company_number;


    }

     public function walletNumber(){

        $initials = 'F365';

            $wallet = Wallet::orderBy('id','desc')->first();

        if (!$wallet) {
            $wallet_number =  $initials .'W'. str_pad(1, 5, "0", STR_PAD_LEFT);
        }else {
            $number = $wallet->id + 1;
            $wallet_number =  $initials .'W'. str_pad($number, 5, "0", STR_PAD_LEFT);
        }

        return  $wallet_number;


    }


    public function run()
    {
       
        $company = new Company;
        $company->type = "admin";
        $company->company_number = $this->companyNumber();
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


        $wallet = new Wallet;
        $wallet->company_id = $company->id;
        $wallet->wallet_name = $company->name;
        $wallet->wallet_number = $this->walletNumber();
        $wallet->currency_id = 1;
        $wallet->balance = 0;
        $wallet->save();

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
