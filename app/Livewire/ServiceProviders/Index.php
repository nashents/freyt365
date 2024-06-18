<?php

namespace App\Livewire\ServiceProviders;

use App\Models\Office;
use App\Models\Country;
use App\Models\Service;
use Livewire\Component;
use App\Models\Currency;
use App\Models\FuelType;
use App\Models\ServiceProvider;
use App\Models\WorkingSchedule;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $countries;
    public $country_id;
    public $city;
    public $name;
    public $lat;
    public $long;
    public $first_day;
    public $last_day;
    public $start_time;
    public $end_time;
    public $everyday = True;
    public $suburb;
    public $contact_name;
    public $contact_surname;
    public $contact_email;
    public $contact_phonenumber;
    public $street_address;
    public $email;
    public $phonenumber;
    public $service_providers;
    public $service_provider;
    public $service_provider_id;
    public $office_id;
    public $offices;
    public $office;
    public $status;
    public $description;
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
        $this->contact_name = "";
        $this->description = "";
        $this->lat = "";
        $this->long = "";
        $this->contact_surname = "";
        $this->contact_email = "";
        $this->contact_phonenumber = "";
        $this->first_day = "";
        $this->last_day = "";
        $this->start_time = "";
        $this->end_time = "";
        $this->status = "";
        $this->everyday = True;
        $this->currency_id = [];
        $this->service_id = [];
        $this->fuel_type_id = [];
    }

    public function store(){

        $service_provider = new ServiceProvider;
        $service_provider->user_id = Auth::user()->id;
        $service_provider->country_id = $this->country_id;
        $service_provider->name = $this->name;
        $service_provider->email = $this->email;
        $service_provider->phonenumber = $this->phonenumber;
        $service_provider->contact_name = $this->contact_name;
        $service_provider->contact_surname = $this->contact_surname;
        $service_provider->contact_phonenumber = $this->contact_phonenumber;
        $service_provider->contact_email = $this->contact_email;
        $service_provider->city = $this->city;
        $service_provider->suburb = $this->suburb;
        $service_provider->street_address = $this->street_address;
        $service_provider->lat = $this->lat;
        $service_provider->long = $this->long;
        $service_provider->description = $this->description;
        $service_provider->save();   

        $working_schedule = new WorkingSchedule;
        $working_schedule->service_provider_id = $service_provider->id;
        $working_schedule->first_day = $this->first_day;
        $working_schedule->last_day = $this->last_day;
        $working_schedule->start_time = $this->start_time;
        $working_schedule->everyday = $this->everyday;
        $working_schedule->save();

        if (isset($this->fuel_type_id)) {
            foreach ($this->fuel_type_id as $key =>  $value) {
                $service_provider->fuel_types()->attach($key);
            }
        }
        if (isset($this->currency_id)) {
            foreach ($this->currency_id as $key => $value) {
                $service_provider->currencies()->attach($key);
            }
        }

       if (isset($this->service_id)) {
          foreach ($this->service_id as $key => $value) {
           $service_provider->services()->attach($key);
          }
       }

        $office = new Office;
        $office->user_id = Auth::user()->id;
        $office->service_provider_id = $this->service_provider_id;
        $office->country_id = $this->country_id;
        $office->name = $this->name;
        $office->email = $this->email;
        $office->phonenumber = $this->phonenumber;
        $office->city = $this->city;
        $office->suburb = $this->suburb;
        $office->street_address = $this->street_address;
        $office->lat = $this->lat;
        $office->long = $this->long;
        $office->status = 1;
        $office->save();

        $working_schedule = new WorkingSchedule;
        $working_schedule->office_id = $office->id;
        $working_schedule->first_day = $this->first_day;
        $working_schedule->last_day = $this->last_day;
        $working_schedule->start_time = $this->start_time;
        $working_schedule->end_time = $this->end_time;
        $working_schedule->everyday = $this->everyday;
        $working_schedule->save();

        if (isset($this->fuel_type_id)) {
            foreach ($this->fuel_type_id as $key =>  $value) {
                $office->fuel_types()->attach($key);
            }
        }
        if (isset($this->currency_id)) {
            foreach ($this->currency_id as $key => $value) {
                $office->currencies()->attach($key);
            }
        }

       if (isset($this->service_id)) {
          foreach ($this->service_id as $key => $value) {
           $office->services()->attach($key);
          }
       }

        $this->dispatch('hide-service_providerModal');
            $this->resetInputFields();
            $this->dispatch(
                'alert',
                type : 'success',
                title : "Service Provider Created Successfully!!",
                position: "center",
            );

    }


    public function showOffice($id){
        $this->service_provider = ServiceProvider::find($id);
        $this->service_provider_id = $id;
        $this->dispatch('show-officeModal');
    }

    public function storeOffice(){

        $office = new Office;
        $office->user_id = Auth::user()->id;
        $office->service_provider_id = $this->service_provider_id;
        $office->country_id = $this->country_id;
        $office->name = $this->name;
        $office->email = $this->email;
        $office->phonenumber = $this->phonenumber;
        $office->city = $this->city;
        $office->suburb = $this->suburb;
        $office->street_address = $this->street_address;
        $office->lat = $this->lat;
        $office->long = $this->long;
        $office->status = 1;
        $office->save();

        $working_schedule = new WorkingSchedule;
        $working_schedule->office_id = $office->id;
        $working_schedule->first_day = $this->first_day;
        $working_schedule->last_day = $this->last_day;
        $working_schedule->start_time = $this->start_time;
        $working_schedule->end_time = $this->end_time;
        $working_schedule->everyday = $this->everyday;
        $working_schedule->save();

        if (isset($this->fuel_type_id)) {
            foreach ($this->fuel_type_id as $key =>  $value) {
                $office->fuel_types()->attach($key);
            }
        }
        if (isset($this->currency_id)) {
            foreach ($this->currency_id as $key => $value) {
                $office->currencies()->attach($key);
            }
        }

       if (isset($this->service_id)) {
          foreach ($this->service_id as $key => $value) {
           $office->services()->attach($key);
          }
       }

        $this->dispatch('hide-officeModal');

        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Office Created Successfully!!",
            position: "center",
        );
    }

    public function editOffice($id, $service_provider_id){
       
        $this->office_id = $id;
        $this->service_provider_id = $service_provider_id;
        $office = Office::find($id);
        $this->country_id = $office->country_id;
        $this->name = $office->name;
        $this->phonenumber = $office->phonenumber;
        $this->email = $office->email;
        $this->city = $office->city;
        $this->suburb = $office->suburb;
        $this->street_address = $office->street_address;
        $this->status = $office->status;   

        $working_schedule = $office->working_schedule;

        $this->first_day = $working_schedule->first_day;
        $this->last_day = $working_schedule->last_day;
        $this->start_time = $working_schedule->start_time;
        $this->end_time = $working_schedule->end_time;
        $this->everyday = $working_schedule->everyday;

        $office_currencies = $office->currencies;
        if (isset($office_currencies)) {
            foreach ($office_currencies as $currency) {
                $this->currency_id[] = $currency->id;
            }
        }

        $office_fuel_types = $office->fuel_types;
        if (isset($office_fuel_types)) {
            foreach ($office_fuel_types as $fuel_type) {
                $this->fuel_type_id[] = $fuel_type->id;
            }
        }


        $office_services = $office->services;
        if (isset($office_services)) {
            foreach ($office_services as $service) {
                $this->service_id[] = $service->id;
            }
        }

        $this->dispatch('show-officeEditModal');

    }

    public function updateOffice(){

        $office = Office::find($this->office_id);
        $office->service_provider_id = $this->service_provider_id;
        $office->country_id = $this->country_id;
        $office->name = $this->name;
        $office->email = $this->email;
        $office->phonenumber = $this->phonenumber;
        $office->city = $this->city;
        $office->suburb = $this->suburb;
        $office->street_address = $this->street_address;
        $office->lat = $this->lat;
        $office->long = $this->long;
        $office->status = $this->status;
        $office->update();

        $working_schedule = $office->working_schedule;
        $working_schedule->office_id = $office->id;
        $working_schedule->first_day = $this->first_day;
        $working_schedule->last_day = $this->last_day;
        $working_schedule->start_time = $this->start_time;
        $working_schedule->end_time = $this->end_time;
        $working_schedule->everyday = $this->everyday;
        $working_schedule->update();

        $office->services()->detach();
        $office->fuel_types()->detach();
        $office->currencies()->detach();
        $office->services()->sync($this->service_id);
        $office->fuel_types()->sync($this->fuel_type_id);
        $office->currencies()->sync($this->currency_id);


        $this->dispatch('hide-officeEditModal');

        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Office Updated Successfully!!",
            position: "center",
        );
    }

    public function deleteOffice($id){
        $office = Office::find($id);
        $working_schedule = $office->working_schedule;
    
        if (isset($working_schedule)) {
            $working_schedule->delete();
        }

        $office->delete();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Office Deleted Successfully!!",
            position: "center",
        );
    }

    public function edit($id){
      
        $this->service_provider_id = $id;
        $service_provider = ServiceProvider::find($id);
        $this->country_id = $service_provider->country_id;
        $this->name = $service_provider->name;
        $this->phonenumber = $service_provider->phonenumber;
        $this->email = $service_provider->email;
        $this->city = $service_provider->city;
        $this->description = $service_provider->description;
        $this->contact_name = $service_provider->contact_name;
        $this->contact_surname = $service_provider->contact_surname;
        $this->contact_email = $service_provider->contact_email;
        $this->contact_phonenumber = $service_provider->contact_phonenumber;
        $this->suburb = $service_provider->suburb;
        $this->street_address = $service_provider->street_address;
        $this->status = $service_provider->status;   
        $this->lat = $service_provider->lat;   
        $this->long = $service_provider->long;   

        $working_schedule = $service_provider->working_schedule;
        if (isset($working_schedule)) {
            $this->first_day = $working_schedule->first_day;
            $this->last_day = $working_schedule->last_day;
            $this->start_time = $working_schedule->start_time;
            $this->end_time = $working_schedule->end_time;
            $this->everyday = $working_schedule->everyday;
        }
      

       

        $service_provider_currencies = $service_provider->currencies;
        if (isset($service_provider_currencies)) {
            foreach ($service_provider_currencies as $currency) {
                $this->currency_id[] = $currency->id;
            }
        }

        $service_provider_fuel_types = $service_provider->fuel_types;
        if (isset($service_provider_fuel_types)) {
            foreach ($service_provider_fuel_types as $fuel_type) {
                $this->fuel_type_id[] = $fuel_type->id;
            }
        }


        $service_provider_services = $service_provider->services;
        if (isset($service_provider_services)) {
            foreach ($service_provider_services as $service) {
                $this->service_id[] = $service->id;
            }
        }

        $this->status = $service_provider->status;
        $this->service_provider_id = $service_provider->id;

        $this->dispatch('show-service_providerEditModal');
    }

   
    public function update(){

        $office = Office::where('service_provider_id', $this->service_provider_id)->where('name',$this->name)->first();

        $service_provider =  ServiceProvider::find($this->service_provider_id);
        $service_provider->country_id = $this->country_id;
        $service_provider->name = $this->name;
        $service_provider->email = $this->email;
        $service_provider->phonenumber = $this->phonenumber;
        $service_provider->contact_name = $this->contact_name;
        $service_provider->contact_surname = $this->contact_surname;
        $service_provider->contact_phonenumber = $this->contact_phonenumber;
        $service_provider->contact_email = $this->contact_email;
        $service_provider->city = $this->city;
        $service_provider->suburb = $this->suburb;
        $service_provider->street_address = $this->street_address;
        $service_provider->lat = $this->lat;
        $service_provider->long = $this->long;
        $service_provider->description = $this->description;
        $service_provider->update();
        
        $service_provider->services()->detach();
        $service_provider->fuel_types()->detach();
        $service_provider->currencies()->detach();
        $service_provider->services()->sync($this->service_id);
        $service_provider->fuel_types()->sync($this->fuel_type_id);
        $service_provider->currencies()->sync($this->currency_id);

        
        $working_schedule = $service_provider->working_schedule ;
        if (isset($working_schedule)) {
            $working_schedule->service_provider_id = $service_provider->id;
            $working_schedule->first_day = $this->first_day;
            $working_schedule->last_day = $this->last_day;
            $working_schedule->start_time = $this->start_time;
            $working_schedule->end_time = $this->end_time;
            $working_schedule->everyday = $this->everyday;
            $working_schedule->update();
        }else {
            $working_schedule = new WorkingSchedule;
            $working_schedule->service_provider_id = $service_provider->id;
            $working_schedule->first_day = $this->first_day;
            $working_schedule->last_day = $this->last_day;
            $working_schedule->start_time = $this->start_time;
            $working_schedule->end_time = $this->end_time;
            $working_schedule->everyday = $this->everyday;
            $working_schedule->save();
        }
       
        if (isset($office)) {
            $office->service_provider_id = $this->service_provider_id;
            $office->country_id = $this->country_id;
            $office->name = $this->name;
            $office->email = $this->email;
            $office->phonenumber = $this->phonenumber;
            $office->city = $this->city;
            $office->suburb = $this->suburb;
            $office->street_address = $this->street_address;
            $office->lat = $this->lat;
            $office->long = $this->long;
            $office->status = $this->status;
            $office->update();

            $office->services()->detach();
            $office->fuel_types()->detach();
            $office->currencies()->detach();
            $office->services()->sync($this->service_id);
            $office->fuel_types()->sync($this->fuel_type_id);
            $office->currencies()->sync($this->currency_id);
    
            $working_schedule = $office->working_schedule;
            $working_schedule->office_id = $office->id;
            $working_schedule->first_day = $this->first_day;
            $working_schedule->last_day = $this->last_day;
            $working_schedule->start_time = $this->start_time;
            $working_schedule->end_time = $this->end_time;
            $working_schedule->everyday = $this->everyday;
            $working_schedule->update();
        }



        $this->dispatch('hide-service_providerEditModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Service Provider Updated Successfully!!",
            position: "center",
        );
    }

    public function delete($id){
        $service_provider = ServiceProvider::find($id);
        $service_provider->services()->detach();
        $service_provider->currencies()->detach();
        $service_provider->fuel_types()->detach();
        $working_schedule = $service_provider->working_schedule;
        if ($working_schedule) {
            $working_schedule->delete();
        }

        $service_provider->delete();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Service Provider Deleted Successfully!!",
            position: "center",
        );
    }

    public function render()
    {
        $this->countries = Country::orderBy('name','asc')->get();
        $this->service_providers = ServiceProvider::orderBy('name','asc')->get();
        return view('livewire.service-providers.index',[
            'countries' => $this->countries,
            'service_providers' => $this->service_providers,
        ]);
    }
}
