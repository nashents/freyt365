<?php

namespace App\Livewire\Authentication;

use Livewire\Component;
use Illuminate\Support\Facades\Password;

class ForgotPassword extends Component
{

    public $email;

    public function updated($value){
        $this->validateOnly($value);
    }

    protected $rules = [
        'email' => 'required|email|exists:users,email',
    ];

    public function submit()
    {
        $this->validate();

        $status = Password::sendResetLink(['email' => $this->email]);

        session()->flash('status', __($status));
    }

    public function render()
    {
        return view('livewire.authentication.forgot-password');
    }
}
