<?php

namespace App\Livewire\Companies;

use App\Models\Wallet;
use Livewire\Component;
use App\Models\BankAccount;

class Show extends Component
{
    public $company;

    public function mount($company){
        $this->company = $company;
    }
    public function render()
    {
        return view('livewire.companies.show');
    }
}
