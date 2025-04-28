<?php

namespace App\Livewire\Companies;

use App\Models\Horse;
use Livewire\Component;

class Horses extends Component
{
    public $horses;
    public $company;

    public function mount($company){
        $this->company = $company;
        $this->horses = Horse::where('company_id', $company->id)->orderBy('registration_number','asc')->get();
    }

    public function render()
    {
        return view('livewire.companies.horses');
    }
}
