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
    public $status;

    public function mount(){
        $this->countries = Country::where('status',1)->orderBy('name','asc')->get();
        $this->currencies = Currency::orderBy('name','asc')->get();
        $this->fuel_types = FuelType::orderBy('name','asc')->get();
        // $this->fuel_stations = collect();
        $this->fuel_stations = FuelStation::orderBy('name','asc')->get();
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
        $this->status = "";
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
        'status' => 'required',
    ];

    public function updatedSelectedCountry($id){
        if (!is_null($id)) {
            $country = Country::find($id);
            $this->fuel_stations = $country->fuel_stations;
        }
    }



    public function store(){

        $fuel_price = FuelPrice::firstOrNew([
        'fuel_station_id' => $this->fuel_station_id,
        'fuel_type_id'    => $this->fuel_type_id,
        ]);

        // Update or set other fields
        $fuel_price->country_id   = $this->selectedCountry;
        $fuel_price->currency_id  = $this->currency_id;
        $fuel_price->pump_price   = $this->pump_price;
        $fuel_price->retail_price = $this->retail_price;
        $fuel_price->stock_level  = $this->stock_level;
        $fuel_price->description  = $this->description;
        $fuel_price->status       = $this->status;

        // Save the record (insert if new or update if existing)
        $fuel_price->save();

        $this->dispatch('hide-fuel_priceModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Fuel Price Created Successfully!!",
            position: "center",
        );
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
        $this->stock_level = $fuel_price->stock_level;
        $this->fuel_price_id = $fuel_price->id;

        $this->dispatch('show-fuel_priceEditModal');
    }
   
    public function update(){
        $fuel_price = FuelPrice::find($this->fuel_price_id);
        $fuel_price->country_id = $this->selectedCountry;
        $fuel_price->currency_id = $this->currency_id;
        $fuel_price->fuel_station_id = $this->fuel_station_id;
        $fuel_price->fuel_type_id = $this->fuel_type_id;
        $fuel_price->pump_price = $this->pump_price;
        $fuel_price->retail_price = $this->retail_price;
        $fuel_price->stock_level = $this->stock_level;
        $fuel_price->description = $this->description;
        $fuel_price->status = $this->status;
        $fuel_price->update();

        $this->dispatch('hide-fuel_priceEditModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Fuel Price Updated Successfully!!",
            position: "center",
        );
    }

    public function delete($id){
        $fuel_price = FuelPrice::find($id);
        $fuel_price->delete();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Fuel Price Deleted Successfully!!",
            position: "center",
        );
    }

    public function render()
    {
        return view('livewire.fuel-prices.index');
    }
}
