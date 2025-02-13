<?php

namespace App\Livewire\FuelStations;

use App\Models\Country;
use App\Models\Service;
use Livewire\Component;
use App\Models\Currency;
use App\Models\FuelType;
use App\Models\FuelStation;
use App\Models\WorkingSchedule;
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
    public $location;
    public $first_day;
    public $last_day;
    public $start_time;
    public $end_time;
    public $everyday = True;
    public $services;
    public $service_id = [];
    public $fuel_types;
    public $fuel_type_id = [];
    public $currencies;
    public $currency_id = [];

    public function mount(){
        $this->fuel_stations = FuelStation::orderBy('name','asc')->get();
        $this->countries = Country::orderBy('name','asc')->get();
        $this->currencies = Currency::orderBy('name','asc')->get();
        $this->fuel_types = FuelType::orderBy('name','asc')->get();
        $this->services = Service::orderBy('name','asc')->get();
    }

    private function resetInputFields(){
      
        $this->name = "";
        $this->country_id = "";
        $this->city = "";
        $this->suburb = "";
        $this->street_address = "";
        $this->phonenumber = "";
        $this->email = "";
        $this->location = "";
        $this->first_day = "";
        $this->last_day = "";
        $this->start_time = "";
        $this->end_time = "";
        $this->everyday = "";
        $this->currency_id = [];
        $this->service_id = [];
        $this->fuel_type_id = [];
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
        $fuel_station->location = $this->location;
        $fuel_station->save();

        if (isset($this->service_id)) {
            foreach ($this->service_id as $key => $value) {
             $fuel_station->services()->attach($key);
            }
         }
         if (isset($this->fuel_type_id)) {
             foreach ($this->fuel_type_id as $key =>  $value) {
                 $fuel_station->fuel_types()->attach($key);
             }
         }
         if (isset($this->currency_id)) {
             foreach ($this->currency_id as $key => $value) {
                 $fuel_station->currencies()->attach($key);
             }
         }
       
       
       
 
         $working_schedule = new WorkingSchedule;
         $working_schedule->user_id = Auth::user()->id;
         $working_schedule->fuel_station_id = $fuel_station->id;
         $working_schedule->first_day = $this->first_day;
         $working_schedule->last_day = $this->last_day;
         $working_schedule->start_time = $this->start_time;
         $working_schedule->end_time = $this->end_time;
         $working_schedule->everyday = $this->everyday;
         $working_schedule->save();


        $this->dispatch('hide-fuel_stationModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Fuel Station Created Successfully!!",
            position: "center",
        );

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
        $this->location = $fuel_station->location;

        $working_schedule = $fuel_station->working_schedule;
        $this->first_day = $working_schedule->first_day;
        $this->last_day = $working_schedule->last_day;
        $this->start_time = $working_schedule->start_time;
        $this->end_time = $working_schedule->end_time;
        $this->everyday = $working_schedule->everyday;

       

        $fuel_station_currencies = $fuel_station->currencies;
        if (isset($fuel_station_currencies)) {
            foreach ($fuel_station_currencies as $currency) {
                $this->currency_id[] = $currency->id;
            }
        }

        $fuel_station_fuel_types = $fuel_station->fuel_types;
        if (isset($fuel_station_fuel_types)) {
            foreach ($fuel_station_fuel_types as $fuel_type) {
                $this->fuel_type_id[] = $fuel_type->id;
            }
        }


        $fuel_station_services = $fuel_station->services;
        if (isset($fuel_station_services)) {
            foreach ($fuel_station_services as $service) {
                $this->service_id[] = $service->id;
            }
        }


        $this->status = $fuel_station->status;
        $this->fuel_station_id = $fuel_station->id;

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
        $fuel_station->location = $this->location;
        $fuel_station->update();

        $fuel_station->services()->detach();
        $fuel_station->fuel_types()->detach();
        $fuel_station->currencies()->detach();
        $fuel_station->services()->sync($this->service_id);
        $fuel_station->fuel_types()->sync($this->fuel_type_id);
        $fuel_station->currencies()->sync($this->currency_id);

        $working_schedule = $fuel_station->working_schedule ;
        $working_schedule->fuel_station_id = $fuel_station->id;
        $working_schedule->first_day = $this->first_day;
        $working_schedule->last_day = $this->last_day;
        $working_schedule->start_time = $this->start_time;
        $working_schedule->end_time = $this->end_time;
        $working_schedule->everyday = $this->everyday;
        
        $working_schedule->update();

        $this->dispatch('hide-fuel_stationEditModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Fuel Station Updated Successfully!!",
            position: "center",
        );

    }

    public function delete($id){
        $fuel_station = FuelStation::find($id);
        $fuel_station->delete();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Fuel Station Deleted Successfully!!",
            position: "center",
        );
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
