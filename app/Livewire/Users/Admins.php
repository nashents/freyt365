<?php

namespace App\Livewire\Users;

use App\Models\Role;
use App\Models\User;
use App\Models\Company;
use Livewire\Component;
use App\Jobs\AccountCreationSMS;
use App\Mail\AccountCreationMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Admins extends Component
{
    public $users;
    public $user_id;
    public $name;
    public $surname;
    public $email;
    public $phonenumber;
    public $password;
    public $password_confirmation;
    public $use_email_as_username;
    public $roles;
    public $role_id = [];
    public $status;
    public $admin;
  

    private function resetInputFields(){
        $this->name = "" ;
        $this->surname = "";
        $this->email = "";
        $this->role_id = [];
        $this->status = "";
        $this->phonenumber = "";
    }

    public function mount(){
        $this->admin = Company::where('type','admin')->first();
        $this->use_email_as_username = "Email";
        $this->users = User::where('company_id', Auth::user()->company_id)->orderBy('name','asc')->get();
        $this->roles = Role::orderBy('name','asc')->get();
    }

    public function updated($value){
        $this->validateOnly($value);
    }
    protected $rules = [
        'name' => 'required',
        'surname' => 'required',
        'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
        'phonenumber' => 'required|unique:users,phonenumber,NULL,id,deleted_at,NULL',
        'password' => 'required|confirmed',
        
    ];

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

    public function store(){

        $pin = $this->generatePIN();
      
        $user = new User;
        $user->user_id = Auth::user()->id;
        $user->company_id = Auth::user()->company_id;
        $user->name = $this->name;
        if (Auth::user()->company->is_admin()) {
            $user->is_admin = 1;
            $user->category = "Admin";
        }else{
            $user->is_admin = 0;
            $user->category = "Employee";
        }
        
        $user->status = 1;
        $user->surname = $this->surname;
        $user->email = $this->email;
        $user->phonenumber = $this->phonenumber;
        if ($this->use_email_as_username == "Email") {
            $user->username = $this->email;
        }elseif ($this->use_email_as_username == "Phonenumber") {
            $user->username = $this->phonenumber;
        }
        $user->pin = $pin;
        $user->password = bcrypt($pin);
        $user->save();
        $user->roles()->sync($this->role_id);

        if (isset($this->email)) {
            Mail::to($this->email)->send(new AccountCreationMail($user, $pin, $this->admin));
        }
       
        // dispatch(new AccountCreationSMS($user, $this->password));

        $this->dispatch('hide-userModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Admin Created Successfully!!",
            position: "center",
        );

   
    }

    public function edit($id){
       
        $user = User::find($id);
        $this->name = $user->name;
        $this->surname = $user->surname;
        $this->email = $user->email;
        $this->phonenumber = $user->phonenumber;
        $this->status = $user->status;
        $user_roles = $user->roles;

        foreach ($user_roles as $role) {
            $this->role_id[] = $role->id;
        }
        $this->user_id = $user->id;
        
        $this->dispatch('show-userEditModal');
    }

    public function update(){
    

        $user =  User::find($this->user_id);
        $user->name = $this->name;
        if (Auth::user()->company->is_admin()) {
            $user->is_admin = 1;
            $user->category = "Admin";
        }else{
            $user->is_admin = 0;
            $user->category = "Employee";
        }
        
        $user->status = $this->status;
        $user->surname = $this->surname;
        $user->email = $this->email;
        $user->phonenumber = $this->phonenumber;
        if ($this->use_email_as_username == "Email") {
            $user->username = $this->email;
        }elseif ($this->use_email_as_username == "Phonenumber") {
            $user->username = $this->phonenumber;
        }
    
        $pin =  $user->pin;
        $user->update();
        $user->roles()->detach();
        $user->roles()->sync($this->role_id);

         if (isset($this->email)) {
            Mail::to($this->email)->send(new AccountCreationMail($user, $pin, $this->admin));
        }

        $this->dispatch('hide-userEditModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Admin Updated Successfully!!",
            position: "center",
        );

  
    }

    public function delete($id){
        $user = User::find($id);
        $user->roles()->detach();
        $user->delete();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Admin Deleted Successfully!!",
            position: "center",
        );
    }

    public function render()
    {
        $this->users = User::where('company_id', Auth::user()->company_id)->orderBy('name','asc')->get();
        return view('livewire.users.admins',[
            'users' => $this->users
        ]);
    }
}
