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
    public $username;
    public $phonenumber;
    public $password;
    public $password_confirmation;
    public $use_email_as_username;
    public $company_id;

    public function updated($value){
        $this->validateOnly($value);
    }
    protected $rules =[
        'name' => 'required',
        'company_name' => 'required',
        'surname' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:2|confirmed',

    ];

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
            $wallet_number =  $initials .'T'. str_pad(1, 5, "0", STR_PAD_LEFT);
        }else {
            $number = $wallet->id + 1;
            $wallet_number =  $initials .'T'. str_pad($number, 5, "0", STR_PAD_LEFT);
        }

        return  $wallet_number;


    }

    public function store(){

        $company = new Company;
        $company->company_number = $this->companyNumber();
        $company->name = $this->company_name;
        $company->email = $this->company_email;
        $company->phonenumber = $this->company_phonenumber;
        $company->type = "Transporter";
        $company->status = "0";
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
        if (isset($company)) {
            $user->company_id = $company->id;
        }
        $user->name = $this->name;
        $user->surname = $this->surname;
        $user->category = "Admin";
        $user->is_admin = 0;
        $user->status = 1;
        $user->email = $this->email;
        $user->phonenumber = $this->phonenumber; 
        $user->username = $this->username;
        $user->password = bcrypt($this->password);
        $user->save();
        $user->roles()->sync(1);
       
        Session::flash('success','Thank you for registering. Our admin team will get in touch for your company verification.');
        return redirect()->route('login');

}
   
    public function render()
    {
        return view('livewire.authentication.signup');
    }
}
