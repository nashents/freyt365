<?php

namespace App\Livewire\Authentication;

use App\Models\User;
use App\Models\Wallet;
use App\Models\Company;
use Livewire\Component;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Signup extends Component
{
    public $company_name;
    public $company_email;
    public $company_phonenumber;
    public $name;
    public $surname;
    public $email;
    public $phonenumber;
    public $password;
    public $password_confirmation;
    public $company_id;

    public function updated($value){
        $this->validateOnly($value);
    }
    protected $rules =[
        'name' => 'required|alpha|min:2',
        'company_name' => 'required|alpha|min:2',
        'surname' => 'required|alpha|min:2',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:2|confirmed',

    ];

    public function employeeNumber(){

        $str = Company::find($this->company_id)->name;
        $words = explode(' ', $str);
        if (isset($words[1][0])) {
            $initials = $words[0][0].$words[1][0];
        }else {
            $initials = $words[0][0];
        }

            $employee = Employee::orderBy('id','desc')->first();

        if (!$employee) {
            $employee_number =  $initials .'E'. str_pad(1, 5, "0", STR_PAD_LEFT);
        }else {
            $number = $employee->id + 1;
            $employee_number =  $initials .'E'. str_pad($number, 5, "0", STR_PAD_LEFT);
        }

        return  $employee_number;


    }

    public function walletNumber(){

        $initials = 'F365';

            $wallet = Wallet::orderBy('id','desc')->first();

        if (!$wallet) {
            $wallet_number =  $initials .'T'. str_pad(1, 5, "0", STR_PAD_LEFT);
        }else {
            $number = $wallet->id + 1;
            $wallet_number =  $initials .'T'. str_pad($number, 5, "0", STR_PAD_LEFT);
        }

        return  $wallet_number;


    }

    public function store(){

        $company = new Company;
        $company->name = $this->company_name;
        $company->email = $this->company_email;
        $company->phonenumber = $this->company_phonenumber;
        $company->authorization = "pending";
        $company->save();
        $this->company_id = $company->id;

        $wallet = new Wallet;
        $wallet->company_id = $company->id;
        $wallet->wallet_name = $company->name;
        $wallet->wallet_number = $this->walletNumber();
        $wallet->currency_id = 1;
        $wallet->balance = 0;
        $wallet->save();

        $user = new User;
        $user->name = $this->name;
        $user->surname = $this->surname;
        $user->email = $this->email;
        $user->phonenumber = $this->phonenumber;
        $user->username = $this->email;
        if (isset($company)) {
            $user->company_id = $company->id;
        }
        $user->password = bcrypt($this->password);
        $user->save();
        $user->roles()->sync(1);
        Auth::login($user);

        // $employee = new Employee;
        // $employee->company_id = $company->id;
        // $employee->user_id = $user->id;
        // $employee->employee_number = $this->employeeNumber();
        // $employee->name = $this->name;
        // $employee->surname = $this->surname;
        // $employee->phonenumber = $this->phonenumber;
        // $employee->email = $this->email;
        // $employee->save();
     
        Session::flash('success','Welcome to your Freyt365 Dashboard');
        return redirect(route('dashboard'));

}
   
    public function render()
    {
        return view('livewire.authentication.signup');
    }
}
