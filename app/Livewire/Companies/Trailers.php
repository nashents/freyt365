<?php

namespace App\Livewire\Companies;

use App\Models\Trailer;
use Livewire\Component;

class Trailers extends Component
{

    public $trailers;
    public $company;

    public function mount($company){
        $this->company = $company;
        $this->trailers = Trailer::where('company_id', $company->id)->orderBy('registration_number','asc')->get();
    }

    public function render()
    {
        return view('livewire.companies.trailers');
    }
}
