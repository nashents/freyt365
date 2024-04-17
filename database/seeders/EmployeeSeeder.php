<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public $password;

    public function employeeNumber(){

            $employee = Employee::orderBy('id', 'desc')->first();

        if (!$employee) {
            $employee_number =  "RC" .'E'. str_pad(1, 5, "0", STR_PAD_LEFT);
        }else {
            $number = $employee->id + 1;
            $employee_number =  "RC" .'E'. str_pad($number, 5, "0", STR_PAD_LEFT);
        }

        return  $employee_number;


    }

    public function run()
    {
        $this->password = "admin12345";
        $user = new User;
        $user->name = "Panashe";
        $user->surname = "Ngorima";
        $user->category = 'admin';
        $user->is_admin = 1;
        $user->use_email_as_username = 1;
        $user->email = "admin@admin";
        $user->username = "admin@admin";
        $user->phonenumber = "0782421799";
        $user->password = bcrypt($this->password);
        $user->save();
        $user->roles()->attach(1);
      
        $admin = new Admin;
        $admin->user_id = $user->id;
        $admin->name = "Panashe";
        $admin->surname = "Ngorima";
        $admin->phonenumber = "0782421799";
        $admin->email = "admin@admin";
        $admin->gender = "Male";
        $admin->dob = "03-05-1995";
        $admin->country = "Zimbabwe";
        $admin->city = "Harare";
        $admin->street_address = "271 Northway Ave Prospect";
        $admin->suburb = "Waterfalls";
        $admin->designation = "Software Developer";

        $employee = new Employee;
        $employee->company_id = 1;
        $employee->user_id = $user->id;
        $employee->employee_number = $this->employeeNumber();
        $employee->name =  "Panashe";
        $employee->surname = "Ngorima";
        $employee->phonenumber =  "0782421799";
        $employee->email = "admin@admin";
        $employee->idnumber = "631550534w44";
        $employee->gender = "Male";
        $employee->dob = "03-05-1995";
        $employee->country ="Zimbabwe";
        $employee->province = "Harare";
        $employee->city = "Harare";
        $employee->street_address =  "271 Northway Ave Prospect";
        $employee->suburb = "Waterfalls";
        $employee->post = "Software Developer";
        $employee->save();
        $employee->departments()->attach(1);
        $employee->ranks()->attach(1);


        
    }
}
