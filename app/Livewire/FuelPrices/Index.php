<?php

namespace App\Livewire\FuelPrices;

use App\Models\Country;
use Livewire\Component;

class Index extends Component
{

    public $countries;
    public $country_id;

    public function mount(){
        $this->countries = Country::orderBy('name','asc')->get();
    }

    public function render()
    {
        return view('livewire.fuel-prices.index');
    }
}
