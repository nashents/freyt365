<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $users;
    public $user_id;
    public $name;
    public $surname;
    public $email;
    public $phonenumber;
    public $status;
  

    private function resetInputFields(){
        $this->name = "" ;
        $this->surname = "";
        $this->license_number = "";
        $this->passport_number = "";
        $this->gender = "";
        $this->dob = "";
        $this->phonenumber = "";
    }

    public function mount(){
        $this->users = User::where('company_id', Auth::user()->company_id)->orderBy('name','asc')->get();
    }

    public function updated($value){
        $this->validateOnly($value);
    }
    protected $rules = [
        'name' => 'required',
        'surname' => 'required',
        'username' => 'required',
        'email' => 'required',
        'phonenumber' => 'required',
    ];

    public function store(){
        try{
        $user = new User;
        $user->user_id = Auth::user()->id;
        $user->company_id = Auth::user()->company_id;
        $user->name = $this->name;
        $user->surname = $this->surname;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->phonenumber = $this->phonenumber;
        $user->save();
        $this->dispatch('hide-userModal');
        $this->resetInputFields();
        $this->dispatch('alert',[
            'type'=>'success',
            'message'=>"User Created Successfully!!"
        ]);

    }catch(\Exception $e){
        // Set Flash Message
        $this->dispatch('alert',[
            'type'=>'error',
            'message'=>"Something went wrong while creating user!!"
        ]);
    }
    }

    public function edit($id){
       
        $user = User::find($id);
        $this->name = $user->name;
        $this->surname = $user->surname;
        $this->email = $user->email;
        $this->phonenumber = $user->phonenumber;
        $this->status = $user->status;
        $this->user_id = $user->id;

        $this->dispatch('show-userEditModal');
    }

    public function update(){
        try{

        $user =  User::find($this->user_id);
        $user->name = $this->name;
        $user->surname = $this->surname;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->phonenumber = $this->phonenumber;
        $user->update();

        $this->dispatch('hide-userEditModal');
        $this->resetInputFields();
        $this->dispatch('alert',[
            'type'=>'success',
            'message'=>"user Created Successfully!!"
        ]);

    }catch(\Exception $e){
        // Set Flash Message
        $this->dispatch('alert',[
            'type'=>'error',
            'message'=>"Something went wrong while creating user!!"
        ]);
    }
    }

    public function render()
    {
        $this->users = User::where('company_id', Auth::user()->company_id)->orderBy('name','asc')->get();
        return view('livewire.users.index',[
            'users' => $this->users
        ]);
    }
}
