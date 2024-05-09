<?php

namespace App\Livewire\FuelStations;

use App\Models\Country;
use Livewire\Component;
use App\Models\FuelStation;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{

    public $fuel_stations;
    public $fuel_station_id;
    public $countries;
    public $country_id;
    public $name;
    public $email;
    public $phonenumber;
    public $city;
    public $suburb;
    public $street_address;
    public $status;
    public $lat;
    public $long;

    public function mount(){
        $this->fuel_stations = FuelStation::orderBy('name','asc')->get();
        $this->countries = Country::orderBy('name','asc')->get();
    }

    private function resetInputFields(){
      
        $this->country_id = "";
        $this->name = "";
        $this->email = "";
        $this->phonenumber = "";
        $this->city = "";
        $this->suburb = "";
        $this->street_address = "";
        $this->lat = "";
        $this->long = "";
    }

    public function updated($value){
        $this->validateOnly($value);
    }
    protected $rules = [
        'country_id' => 'required',
        'name' => 'required',
        'city' => 'required',
    ];

    public function store(){
        
        $fuel_station = new FuelStation;
        $fuel_station->user_id = Auth::user()->id;
        $fuel_station->country_id = $this->country_id;
        $fuel_station->name = $this->name;
        $fuel_station->email = $this->email;
        $fuel_station->phonenumber = $this->phonenumber;
        $fuel_station->city = $this->city;
        $fuel_station->suburb = $this->suburb;
        $fuel_station->street_address = $this->street_address;
        $fuel_station->lat = $this->lat;
        $fuel_station->long = $this->long;
        $fuel_station->save();

        $this->dispatch('hide-fuel_stationModal');
        $this->resetInputFields();
        $this->dispatch('alert',[
            'type'=>'success',
            'message'=>"Fuel Station Created Successfully!!"
        ]);

    }

    public function edit($id){
        $fuel_station = FuelStation::find($id);

        $this->country_id = $fuel_station->country_id;
        $this->name = $fuel_station->name;
        $this->city = $fuel_station->city;
        $this->email = $fuel_station->email;
        $this->phonenumber = $fuel_station->phonenumber;
        $this->suburb = $fuel_station->suburb;
        $this->street_address = $fuel_station->street_address;
        $this->fuel_station_id = $fuel_station->id;
        $this->status = $fuel_station->status;
        $this->long = $fuel_station->long;
        $this->lat = $fuel_station->lat;

        $this->dispatch('show-fuel_stationEditModal');
    }

    public function update(){
        
        $fuel_station = FuelStation::find($this->fuel_station_id);
        $fuel_station->country_id = $this->country_id;
        $fuel_station->name = $this->name;
        $fuel_station->email = $this->email;
        $fuel_station->phonenumber = $this->phonenumber;
        $fuel_station->city = $this->city;
        $fuel_station->suburb = $this->suburb;
        $fuel_station->street_address = $this->street_address;
        $fuel_station->status = $this->status;
        $fuel_station->lat = $this->lat;
        $fuel_station->long = $this->long;
        $fuel_station->update();

        $this->dispatch('hide-fuel_stationEditModal');
        $this->resetInputFields();
        $this->dispatch('alert',[
            'type'=>'success',
            'message'=>"Fuel Station Updated Successfully!!"
        ]);

    }

    public function delete($id){
        $fuel_station = FuelStation::find($id);
        $fuel_station->delete();
        $this->dispatch('alert',[
            'type'=>'success',
            'message'=>"Fuel Station Deleted Successfully!!"
        ]);
    }

    public function render()
    {
        $this->fuel_stations = FuelStation::orderBy('name','asc')->get();
        $this->countries = Country::orderBy('name','asc')->get();
        return view('livewire.fuel-stations.index',[
            'fuel_stations' => $this->fuel_stations,
            'countries' => $this->countries,
        ]);
    }
}
