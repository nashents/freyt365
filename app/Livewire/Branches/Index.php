<?php

namespace App\Livewire\Branches;

use App\Models\Branch;
use App\Models\Country;
use App\Models\Service;
use Livewire\Component;
use App\Models\Currency;
use App\Models\FuelType;
use App\Models\WorkingSchedule;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{

    public $countries;
    public $country_id;
    public $city;
    public $name;
    public $suburb;
    public $street_address;
    public $email;
    public $phonenumber;
    public $lat;
    public $long;
    public $branches;
    public $branch_id;
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
        $this->lat = "";
        $this->long = "";
        $this->first_day = "";
        $this->last_day = "";
        $this->start_time = "";
        $this->end_time = "";
        $this->everyday = "";
        $this->currency_id = "";
        $this->service_id = "";
        $this->fuel_type_id = "";
    }

    public function store(){

      

        $branch = new Branch;
        $branch->user_id = Auth::user()->id;
        $branch->country_id = $this->country_id;
        $branch->name = $this->name;
        $branch->email = $this->email;
        $branch->phonenumber = $this->phonenumber;
        $branch->city = $this->city;
        $branch->suburb = $this->suburb;
        $branch->street_address = $this->street_address;
        $branch->lat = $this->lat;
        $branch->long = $this->long;
        $branch->save();

        if (isset($this->service_id)) {
           foreach ($this->service_id as $key => $value) {
            $branch->services()->attach($key);
           }
        }
        if (isset($this->fuel_type_id)) {
            foreach ($this->fuel_type_id as $key =>  $value) {
                $branch->fuel_types()->attach($key);
            }
        }
        if (isset($this->currency_id)) {
            foreach ($this->currency_id as $key => $value) {
                $branch->currencies()->attach($key);
            }
        }
      
      
      

        $working_schedule = new WorkingSchedule;
        $working_schedule->user_id = Auth::user()->id;
        $working_schedule->branch_id = $branch->id;
        $working_schedule->first_day = $this->first_day;
        $working_schedule->last_day = $this->last_day;
        $working_schedule->start_time = $this->start_time;
        $working_schedule->end_time = $this->end_time;
        $working_schedule->everyday = $this->everyday;
        $working_schedule->save();

        $this->dispatch('hide-branchModal');
            $this->resetInputFields();
            $this->dispatch('alert',[
                'type'=>'success',
                'message'=>"Branch Created Successfully!!"
            ]);

    }

    public function edit($id){
      
        $this->branch_id = $id;
        $branch = Branch::find($id);
      
        $this->country_id = $branch->country_id;
        $this->name = $branch->name;
        $this->phonenumber = $branch->phonenumber;
        $this->email = $branch->email;
        $this->city = $branch->city;
        $this->suburb = $branch->suburb;
        $this->street_address = $branch->street_address;
        $this->lat = $branch->lat;
        $this->long = $branch->long;
        $this->status = $branch->status;
        
      

        $working_schedule = $branch->working_schedule;
        $this->first_day = $working_schedule->first_day;
        $this->last_day = $working_schedule->last_day;
        $this->start_time = $working_schedule->start_time;
        $this->end_time = $working_schedule->end_time;
        $this->everyday = $working_schedule->everyday;

       

        $branch_currencies = $branch->currencies;
        if (isset($branch_currencies)) {
            foreach ($branch_currencies as $currency) {
                $this->currency_id[] = $currency->id;
            }
        }

        $branch_fuel_types = $branch->fuel_types;
        if (isset($branch_fuel_types)) {
            foreach ($branch_fuel_types as $fuel_type) {
                $this->fuel_type_id[] = $fuel_type->id;
            }
        }


        $branch_services = $branch->services;
        if (isset($branch_services)) {
            foreach ($branch_services as $service) {
                $this->service_id[] = $service->id;
            }
        }


        $this->status = $branch->status;
        $this->branch_id = $branch->id;

        $this->dispatch('show-branchEditModal');
    }

   
    public function update(){
        $branch =  Branch::find($this->branch_id);
        $branch->country_id = $this->country_id;
        $branch->name = $this->name;
        $branch->email = $this->email;
        $branch->phonenumber = $this->phonenumber;
        $branch->city = $this->city;
        $branch->suburb = $this->suburb;
        $branch->street_address = $this->street_address;
        $branch->update();
        $branch->services()->detach();
        $branch->fuel_types()->detach();
        $branch->currencies()->detach();
        $branch->services()->sync($this->service_id);
        $branch->fuel_types()->sync($this->fuel_type_id);
        $branch->currencies()->sync($this->currency_id);

        $working_schedule = $branch->working_schedule ;
        $working_schedule->branch_id = $branch->id;
        $working_schedule->first_day = $this->first_day;
        $working_schedule->last_day = $this->last_day;
        $working_schedule->start_time = $this->start_time;
        $working_schedule->end_time = $this->end_time;
        $working_schedule->everyday = $this->everyday;
        $working_schedule->update();

        $this->dispatch('hide-branchEditModal');
            $this->resetInputFields();
            $this->dispatch('alert',[
                'type'=>'success',
                'message'=>"Branch Updated Successfully!!"
            ]);
    }

    public function delete($id){
        $branch = Branch::find($id);

        $services = $branch->services;
        $fuel_types = $branch->fuel_types;
        $currencies = $branch->currencies;

        if (isset($currencies)) {
            foreach ($currencies as $currency) {
              $currency->delete();
            }
        }
        if (isset($fuel_types)) {
            foreach ($fuel_types as $fuel_type) {
              $fuel_type->delete();
            }
        }
        if (isset($services)) {
            foreach ($services as $service) {
              $service->delete();
            }
        }

        $branch->delete();
        $this->dispatch('alert',[
            'type'=>'success',
            'message'=>"Branch Deleted Successfully!!"
        ]);
    }

    public function render()
    {
        $this->countries = Country::orderBy('name','asc')->get();
        return view('livewire.branches.index',[
            'countries' => $this->countries
        ]);
    }
}
