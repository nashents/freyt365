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

class Index extends Component
{
    public $users;
    public $user_id;
    public $name;
    public $surname;
    public $email;
    public $phonenumber;
    public $username;
    public $password;
    public $password_confirmation;
    public $roles;
    public $role_id = [];
    public $status;
  

    private function resetInputFields(){
        $this->name = "" ;
        $this->surname = "";
        $this->username = "";
        $this->email = "";
        $this->role_id = [];
        $this->status = "";
        $this->phonenumber = "";
    }

    public function mount(){
        $this->users = User::where('company_id', Auth::user()->company_id)->orderBy('name','asc')->get();
        $this->roles = Role::orderBy('name','asc')->get();
    }

    public function updated($value){
        $this->validateOnly($value);
    }
    protected $rules = [
        'name' => 'required',
        'surname' => 'required',
        'username' => 'required|unique:users,username,NULL,id,deleted_at,NULL',
        'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
        'phonenumber' => 'required|unique:users,phonenumber,NULL,id,deleted_at,NULL',
        'password' => 'required|confirmed',
        
    ];

    public function store(){
      
        $user = new User;
        $user->user_id = Auth::user()->id;
        $user->company_id = Auth::user()->company_id;
        $user->name = $this->name;
        if (Auth::user()->company == "admin") {
            $user->is_admin = 1;
        }else{
            $user->is_admin = 0;
        }
        $user->category = "Employee";
        $user->status = 1;
        $user->surname = $this->surname;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->phonenumber = $this->phonenumber;
        $user->password = bcrypt($this->password);
        $user->save();
        $user->roles()->sync($this->role_id);

        $company = Company::find(Auth::user()->company_id);

        if (isset($this->email)) {
            Mail::to($this->email)->send(new AccountCreationMail($user, $company, $this->password));
        }
       
        dispatch(new AccountCreationSMS($user, $this->password));

        $this->dispatch('hide-userModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "User Created Successfully!!",
            position: "center",
        );

   
    }

    public function edit($id){
       
        $user = User::find($id);
        $this->name = $user->name;
        $this->surname = $user->surname;
        $this->email = $user->email;
        $this->phonenumber = $user->phonenumber;
        $this->username = $user->username;
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
        $user->category = "Employee";
        if (Auth::user()->company == "admin") {
            $user->is_admin = 1;
        }else{
            $user->is_admin = 0;
        }
        $user->status = 1;
        $user->surname = $this->surname;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->phonenumber = $this->phonenumber;
        $user->password = bcrypt($this->password);
        $user->update();
        $user->roles()->detach();
        $user->roles()->sync($this->role_id);

        $this->dispatch('hide-userEditModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "User Updated Successfully!!",
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
            title : "User Deleted Successfully!!",
            position: "center",
        );
    }

    public function render()
    {
        $this->users = User::where('company_id', Auth::user()->company_id)->orderBy('name','asc')->get();
        return view('livewire.users.index',[
            'users' => $this->users
        ]);
    }
}
