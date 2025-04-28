<?php

namespace App\Livewire\Companies;

use App\Models\Driver;
use Livewire\Component;

class Drivers extends Component
{
    public $drivers;
    public $company;

    public function mount($company){
        $this->company = $company;
        $this->drivers = Driver::where('company_id', $company->id)->orderBy('name','asc')->orderBy('surname','asc')->get();
    }

    public function render()
    {
        return view('livewire.companies.drivers');
    }
}
