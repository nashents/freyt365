<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Show extends Component
{

    public $user;
    public $name;
    public $surname;
    public $email;
    public $phonenumber;
    public $username;
    public $current_password;
    public $password;
    public $password_confirmation;

    public function mount($id){
        $this->user = User::find($id);
        $this->name = $this->user->name;
        $this->surname = $this->user->surname;
        $this->email = $this->user->email;
        $this->phonenumber = $this->user->phonenumber;
        $this->username = $this->user->username;
    }

    protected $rules = [
        'name' => 'required',
        'surname' => 'nullable',
        'username' => 'required',
        'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
        'phonenumber' => 'required|unique:users,phonenumber,NULL,id,deleted_at,NULL',
        'current_password' => ['nullable', 'current_password'],
        'password' => ['nullable', 'string', 'min:8', 'confirmed', 'regex:/[^a-zA-Z0-9]/'],
    ];

    protected $messages = [
        'current_password.current_password' => 'The current password you entered is incorrect.',
        'password.regex' => 'The new password must include at least one special character.',
    ];

    public function updated($value){
        $this->validateOnly($value);
    }

    public function update(){
        $user = $this->user;
        $user->name = $this->name;
        $user->surname = $this->surname;
        $user->phonenumber = $this->phonenumber;
        $user->email = $this->email;
        $user->username = $this->username;
        $user->pin = $this->password;
        if (isset($this->password)) {
            $user->password = Hash::make($this->password);
        }
        $user->update();

        $this->reset(['current_password', 'password', 'password_confirmation']);

        $this->dispatch(
            'alert',
            type : 'success',
            title : "Profile Updated Successfully!!",
            position: "center",
        );
    }

    public function render()
    {
        return view('livewire.users.show');
    }
}
