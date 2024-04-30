<?php

namespace App\Livewire\Companies;

use App\Models\Company;
use Livewire\Component;

class Index extends Component
{

    public $companies;
    public $company_id;

    public function mount(){
        $this->companies = Company::orderBy('name','asc')->get();
    }

    public function render()
    {
        return view('livewire.companies.index');
    }
}
