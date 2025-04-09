<?php

namespace App\Livewire\Authentication;

use App\Models\User;
use App\Models\Wallet;
use App\Models\Company;
use App\Models\Country;
use Livewire\Component;
use App\Mail\SignupMail;
use App\Models\Currency;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
    public $countries;
    public $country;
    public $city;
    public $suburb;
    public $street_address;
    public $password;
    public $password_confirmation;
    public $use_email_as_username = "Email";
    public $company_id;

    public function mount(){
        $this->countries = Country::orderBy('name','asc')->get();
    }

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
            $wallet_number =  $initials .'W'. str_pad(1, 5, "0", STR_PAD_LEFT);
        }else {
            $number = $wallet->id + 1;
            $wallet_number =  $initials .'W'. str_pad($number, 5, "0", STR_PAD_LEFT);
        }

        return  $wallet_number;


    }

    public function store(){

        $company = new Company;
        $company->company_number = $this->companyNumber();
        $company->name = $this->company_name;
        $company->email = $this->company_email;
        $company->country = $this->country;
        $company->city = $this->city;
        $company->street_address = $this->street_address;
        $company->suburb = $this->suburb;
        $company->phonenumber = $this->company_phonenumber;
        $company->type = "Transporter";
        $company->is_admin = 0;
        $company->status = "0";
        $company->save();
        $this->company_id = $company->id;

       

        $wallet = new Wallet;
        $wallet->company_id = $company->id;
        $wallet->name = $company->name;
        $wallet->description = "This is your company`s default wallet for transactions.";
        $wallet->wallet_number = $this->walletNumber();
        $currency = Currency::where('name','USD')->first();
        if (isset($currency)) {
            $wallet->currency_id = $currency->id;
        }
        $wallet->active = 0;
        $wallet->default = 1;
        $wallet->balance = 0;
        $wallet->save();

        $user = new User;
        if (isset($company)) {
            $user->company_id = $company->id;
        }
        
        $user->name = $this->name;
        $user->surname = $this->surname;
        $user->category = "Employee";
        $user->is_admin = 0;
        $user->status = 1;
        $user->email = $this->email;
        $user->phonenumber = $this->phonenumber; 
        if ($this->use_email_as_username == "Email") {
            $user->username = $this->email;
        }elseif($this->use_email_as_username == "Phonenumber"){
            $user->username = $this->phonenumber;
        }
        $user->pin = $this->password;
        $user->password = bcrypt($this->password);
        $user->save();
        $user->roles()->sync(1);
       
        if (isset($this->email)) {
            Mail::to($this->email)->send(new SignupMail($user));
        }
      

        Session::flash('success','Thank you for signup. Our admin will get in touch with you via email.');
        return redirect()->route('login');
      

}
   
    public function render()
    {
        return view('livewire.authentication.signup');
    }
}
