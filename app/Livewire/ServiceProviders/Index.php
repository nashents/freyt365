<?php

namespace App\Livewire\ServiceProviders;

use App\Models\Office;
use App\Models\Country;
use App\Models\Service;
use Livewire\Component;
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
    public $service_provider_id;
    public $services;
    public $service_id = [];
  

    public function mount(){
        $this->countries = Country::orderBy('name','asc')->get();
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
        $this->service_id = "";
        $this->contact_name = "";
        $this->contact_surname = "";
        $this->contact_email = "";
        $this->contact_phonenumber = "";
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
        $service_provider->save();

        if (isset($this->service_id)) {
           foreach ($this->service_id as $key => $value) {
            $service_provider->services()->attach($key);
           }
        }
       

        $this->dispatch('hide-service_providerModal');
            $this->resetInputFields();
            $this->dispatch('alert',[
                'type'=>'success',
                'message'=>"Service Provider Created Successfully!!"
            ]);

    }


    public function showOffice($id){
        $this->service_provider = ServiceProvider::find($id);
        $this->service_provider_id = $id;
        $this->dispatch('show-officeModal');
    }

    public function storeOffice(){

        $office = new Office;
        $office->user_id = Auth::user()->id;
        $office->service_provider_id = $this->service_provider->id;
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
        $working_schedule->everyday = $this->everyday;
        $working_schedule->save();

        $this->dispatch('hide-officeModal');

        $this->resetInputFields();
        $this->dispatch('alert',[
            'type'=>'success',
            'message'=>"Office Created Successfully!!"
        ]);
    }

    public function editOffice($id){

        $this->office_id = $id;
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
        $this->first_day = $office->first_day;
        $this->last_day = $office->last_day;
        $this->start_time = $office->start_time;
        $this->end_time = $office->end_time;
        $this->everyday = $office->everyday;

        $this->dispatch('show-officeEditModal');

    }

    public function updateOffice(){

        $office = Office::find($this->office_id);
        $office->user_id = Auth::user()->id;
        $office->service_provider_id = $this->service_provider->id;
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
        $working_schedule->everyday = $this->everyday;
        $working_schedule->update();

        $this->dispatch('hide-officeEditModal');

        $this->resetInputFields();
        $this->dispatch('alert',[
            'type'=>'success',
            'message'=>"Office Updated Successfully!!"
        ]);
    }

    public function deleteOffice($id){
        $office = Office::find($id);
        $working_schedule = $office->working_schedule;
    
        if (isset($working_schedule)) {
            $working_schedule->delete();
        }

        $office->delete();
        $this->dispatch('alert',[
            'type'=>'success',
            'message'=>"Office Deleted Successfully!!"
        ]);
    }

    public function edit($id){
      
        $this->service_provider_id = $id;
        $service_provider = ServiceProvider::find($id);
        $this->country_id = $service_provider->country_id;
        $this->name = $service_provider->name;
        $this->phonenumber = $service_provider->phonenumber;
        $this->email = $service_provider->email;
        $this->city = $service_provider->city;
        $this->contact_name = $service_provider->contact_name;
        $this->contact_surname = $service_provider->contact_surname;
        $this->contact_email = $service_provider->contact_email;
        $this->contact_phonenumber = $service_provider->contact_phonenumber;
        $this->suburb = $service_provider->suburb;
        $this->street_address = $service_provider->street_address;
        $this->status = $service_provider->status;   

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
        $service_provider->update();
        $service_provider->services()->detach();
        $service_provider->services()->sync($this->service_id);

        $this->dispatch('hide-service_providerEditModal');
        $this->resetInputFields();
        $this->dispatch('alert',[
            'type'=>'success',
            'message'=>"Service Provider Updated Successfully!!"
        ]);
    }

    public function delete($id){
        $service_provider = ServiceProvider::find($id);
        $services = $service_provider->services;
    
        if (isset($services)) {
            foreach ($services as $service) {
              $service->delete();
            }
        }

        $service_provider->delete();
        $this->dispatch('alert',[
            'type'=>'success',
            'message'=>"Service Provider Deleted Successfully!!"
        ]);
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
