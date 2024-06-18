<?php

namespace App\Livewire\Orders;

use App\Models\Horse;
use App\Models\Driver;
use App\Models\Wallet;
use App\Models\Country;
use App\Models\Service;
use App\Models\Trailer;
use Livewire\Component;
use App\Models\Currency;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{

    public $wallets;
    public $wallet_id;
    public $horses;
    public $horse_id;
    public $drivers;
    public $driver_id;
    public $countries;
    public $service_providers;
    public $service_provider_id;
    public $services;
    public $service_id;
    public $selectedCountry;
    public $country;
    public $trailers;
    public $trailer_id = [];

    public function mount(){
        $this->customers = Customer::orderBy('name','asc')->get();
        $this->drivers = Driver::orderBy('name','asc')->get();
        $this->horses = Horse::orderBy('registration_number','asc')->get();
        $this->trailers = Trailer::orderBy('registration_number','asc')->get();
        $this->currencies = Currency::orderBy('name','asc')->get();
        $this->countries = Country::orderBy('name','asc')->get();
        $this->services = Service::orderBy('name','asc')->get();
        $this->wallets = Wallet::where('company_id',Auth::user()->company_id)->get();
    }

    public function updatedSelectedCountry($id){
        if (!is_null($id)) {
            $this->country = Country::find($id);
            $this->service_providers = $this->country->service_providers;
        }
    }

    public function render()
    {
        return view('livewire.orders.create');
    }
}
