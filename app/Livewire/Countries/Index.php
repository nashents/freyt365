<?php

namespace App\Livewire\Countries;

use App\Models\Country;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    
    public $countries;
    public $name;
    public $country_id;
    public $status;

    public function mount(){
    
    }

    private function resetInputFields(){
      
        $this->percentage = "";
        $this->transaction_type_id = "";
    }

    public function store(){
        $country = new Country;
        $country->user_id = Auth::user()->id;
        $country->name = $this->name;
        $country->status = 1;
        $country->save();

        $this->dispatch('hide-countryModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Country Created Successfully!!",
            position: "center",
        );
    }

    public function edit($id){
        $country = Country::find($id);
        $this->name = $country->name;
        $this->status = $country->status;
        $this->country_id = $country->id;

        $this->dispatch('show-countryEditModal');
    }

    public function update(){
        $country =  Country::find($this->country_id);
        $country->name = $this->name;
        $country->status = $this->status;
        $country->update();

        $this->dispatch('hide-countryEditModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Country Updated Successfully!!",
            position: "center",
        );
    }

    public function delete($id){
        
        $country = Country::find($id);
        $country->delete();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Country Deleted Successfully!!",
            position: "center",
        );
    }

    public function render()
    {
        $this->countries = Country::orderBy('name','asc')->get();
        return view('livewire.countries.index',[
            'countries' => $this->countries
        ]);
    }
}
