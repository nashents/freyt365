<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class Profile extends Component
{

    public $user;
    public $name;
    public $surname;
    public $email;
    public $phonenumber;
    public $username;

    public function mount($id){
        $this->user = User::find($id);
        $this->name = $this->user->name;
        $this->surname = $this->user->surname;
        $this->email = $this->user->email;
        $this->phonenumber = $this->user->phonenumber;
        $this->username = $this->user->username;
    }

    public function update(){
        $user = $this->user;
        $user->name = $this->name;
        $user->surname = $this->surname;
        $user->phonenumber = $this->phonenumber;
        $user->email = $this->email;
        $user->username = $this->username;
        $user->update();

        $this->dispatch(
            'alert',
            type : 'success',
            title : "Profile Updated Successfully!!",
            position: "center",
        );
    }

    public function render()
    {
        return view('livewire.users.profile');
    }
}
