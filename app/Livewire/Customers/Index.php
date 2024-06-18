<?php

namespace App\Livewire\Customers;

use App\Models\Country;
use Livewire\Component;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{

    public $customers;
    public $customer;
    public $customer_id;
    public $name;
    public $surname;
    public $email;
    public $phonenumber;
    public $countries;
    public $country_id;
    public $city;
    public $suburb;
    public $street_address;
    public $status;
    public $vat;
    public $tin;

    public function mount(){
        $this->customers = Customer::orderBy('name','asc')->get();
        $this->countries = Country::orderBy('name','asc')->get();
    }

    private function resetInputFields(){
        $this->name = "" ;
        $this->surname = "" ;
        $this->email = "";
        $this->phonenumber = "";
        $this->country_id = "";
        $this->vat = "";
        $this->tin = "";
        $this->city = "";
        $this->suburb = "";
        $this->street_address = "";
        $this->status = "";
    }

    public function updated($value){
        $this->validateOnly($value);
    }
    protected $rules = [
        'name' => 'required',
    ];


    public function store(){
        
        $customer = new Customer;
        $customer->user_id = Auth::user()->id;
        $customer->name = $this->name;
        $customer->email = $this->email;
        $customer->phonenumber = $this->phonenumber;
        $customer->country_id = $this->country_id;
        $customer->vat = $this->vat;
        $customer->tin = $this->tin;
        $customer->city = $this->city;
        $customer->suburb = $this->suburb;
        $customer->street_address = $this->street_address;
        $customer->save();

        $this->dispatch('hide-customerModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Customer Created Successfully!!",
            position: "center",
        );
    }

    public function edit($id){
        $customer = Customer::find($id);
        $this->name = $customer->name;
        $this->email = $customer->email;
        $this->phonenumber = $customer->phonenumber;
        $this->country_id = $customer->country_id;
        $this->city = $customer->city;
        $this->vat = $customer->vat;
        $this->tin = $customer->tin;
        $this->suburb = $customer->suburb;
        $this->street_address = $customer->street_address;
        $this->status = $customer->status;
        $this->customer_id = $customer->id;

        $this->dispatch('show-customerEditModal');
    }

    public function update(){

        $customer = Customer::find($this->customer_id);
        $customer->user_id = Auth::user()->id;
        $customer->name = $this->name;
        $customer->email = $this->email;
        $customer->vat = $this->vat;
        $customer->tin = $this->tin;
        $customer->phonenumber = $this->phonenumber;
        $customer->country_id = $this->country_id;
        $customer->city = $this->city;
        $customer->suburb = $this->suburb;
        $customer->street_address = $this->street_address;
        $customer->status = $this->status;
        $customer->update();

        $this->dispatch('hide-customerEditModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Customer Updated Successfully!!",
            position: "center",
        );
    }


    public function delete($id){
        $customer = Customer::find($id);
        $customer->delete();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Customer Deleted Successfully!!",
            position: "center",
        );
    }

    public function render()
    {
        $this->customers = Customer::orderBy('name','asc')->get();
        return view('livewire.customers.index',[
            'customers' => $this->customers
        ]);
    }
}
