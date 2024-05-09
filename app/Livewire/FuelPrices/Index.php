<?php

namespace App\Livewire\FuelPrices;

use App\Models\Country;
use Livewire\Component;
use App\Models\Currency;
use App\Models\FuelType;
use App\Models\FuelPrice;
use App\Models\FuelStation;

class Index extends Component
{

    public $countries;
    public $selectedCountry;
    public $currencies;
    public $currency_id;
    public $fuel_price_id;
    public $fuel_prices;
    public $fuel_stations;
    public $fuel_station_id;
    public $fuel_types;
    public $fuel_type_id;
    public $pump_price;
    public $retail_price;
    public $description;
    public $stock_level;

    public function mount(){
        $this->countries = Country::orderBy('name','asc')->get();
        $this->currencies = Currency::orderBy('name','asc')->get();
        $this->fuel_types = FuelType::orderBy('name','asc')->get();
        $this->fuel_stations = collect();
    }

    private function resetInputFields(){
      
        $this->selectedCountry = "";
        $this->fuel_station_id = "";
        $this->fuel_type_id = "";
        $this->currency_id = "";
        $this->pump_price = "";
        $this->retail_price = "";
        $this->stock_level = "";
        $this->description = "";
    }

    public function updated($value){
        $this->validateOnly($value);
    }
    protected $rules = [
        'selectedCountry' => 'required',
        'fuel_station_id' => 'required',
        'currency_id' => 'required',
        'pump_price' => 'required',
        'retail_price' => 'required',
        'stock_level' => 'required',
    ];

    public function updatedSelectedCountry($id){
        if (!is_null($id)) {
            $country = Country::find($id);
            $this->fuel_stations = $country->fuel_stations;
        }
    }



    public function store(){
        $fuel_price = new FuelPrice;
        $fuel_price->country_id = $this->selectedCountry;
        $fuel_price->currency_id = $this->currency_id;
        $fuel_price->fuel_station_id = $this->fuel_station_id;
        $fuel_price->fuel_type_id = $this->fuel_type_id;
        $fuel_price->pump_price = $this->pump_price;
        $fuel_price->retail_price = $this->retail_price;
        $fuel_price->stock_level = $this->stock_level;
        $fuel_price->description = $this->description;
        $fuel_price->save();

        $this->dispatch('hide-fuel_priceModal');
        $this->resetInputFields();
        $this->dispatch('alert',[
            'type'=>'success',
            'message'=>"Fuel Price Added Successfully!!"
        ]);
    }

    public function edit($id){
        $fuel_price = FuelPrice::find($id);
        $this->selectedCountry = $fuel_price->country_id;
        $this->fuel_station_id = $fuel_price->fuel_station_id;
        $this->fuel_type_id = $fuel_price->fuel_type_id;
        $this->currency_id = $fuel_price->currency_id;
        $this->pump_price = $fuel_price->pump_price;
        $this->retail_price = $fuel_price->retail_price;
        $this->description = $fuel_price->description;
        $this->status = $fuel_price->status;
        $this->fuel_price_id = $fuel_price->id;

        $this->dispatch('show-fuel_priceEditModal');
    }
   
    public function update(){
        $fuel_price = FuelPrice::find($this->fuel_price);
        $fuel_price->country_id = $this->selectedCountry;
        $fuel_price->currency_id = $this->currency_id;
        $fuel_price->fuel_station_id = $this->fuel_station_id;
        $fuel_price->fuel_type_id = $this->fuel_type_id;
        $fuel_price->pump_price = $this->pump_price;
        $fuel_price->retail_price = $this->retail_price;
        $fuel_price->stock_level = $this->stock_level;
        $fuel_price->description = $this->description;
        $fuel_price->save();

        $this->dispatch('hide-fuel_priceModal');
        $this->resetInputFields();
        $this->dispatch('alert',[
            'type'=>'success',
            'message'=>"Fuel Price Added Successfully!!"
        ]);
    }

    public function delete($id){
        $fuel_price = FuelPrice::find($id);
        $fuel_price->delete();
        $this->dispatch('alert',[
            'type'=>'success',
            'message'=>"Fuel Price Deleted Successfully!!"
        ]);
    }

    public function render()
    {
        return view('livewire.fuel-prices.index');
    }
}
