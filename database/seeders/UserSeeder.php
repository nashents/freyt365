<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public $password;



    public function run()
    {
        $this->password = "admin12345";
        $user = new User;
        $user->name = "Panashe";
        $user->surname = "Ngorima";
        $user->category = 'admin';
        $user->is_admin = 1;
        $user->use_email_as_username = 1;
        $user->email = "pngorima@gonyetitls.com";
        $user->username = "pngorima@gonyetitls.com";
        $user->phonenumber = "0782421799";
        $user->password = bcrypt($this->password);
        $user->save();
        $user->roles()->attach(1);
      
        $admin = new Admin;
        $admin->user_id = $user->id;
        $admin->name = "Panashe";
        $admin->surname = "Ngorima";
        $admin->phonenumber = "0782421799";
        $admin->email = "pngorima@gonyetitls.com";
        $admin->gender = "Male";
        $admin->dob = "03-05-1995";
        $admin->country = "Zimbabwe";
        $admin->city = "Harare";
        $admin->street_address = "271 Northway Ave Prospect";
        $admin->suburb = "Waterfalls";
        $admin->designation = "Software Developer";

 
        
    }
}
