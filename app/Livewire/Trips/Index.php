<?php

namespace App\Livewire\Trips;

use App\Models\Trip;
use App\Models\Horse;
use App\Models\Driver;
use App\Models\Trailer;
use Livewire\Component;
use App\Models\Currency;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{

    public $trips;
    public $trip_id;
    public $weight;
    public $rate;
    public $freight;
    public $from;
    public $to;
    public $customers;
    public $customer_id;
    public $horses;
    public $horse_id;
    public $trailers;
    public $trailer_id = [];
    public $drivers;
    public $driver_id;
    public $currencies;
    public $currency_id;
    public $cargo;
    public $status;
    public $trip_ref;
    public $description;
    public $litreage;
    public $start_date;

    private function resetInputFields(){
        $this->trip_ref = "" ;
        $this->horse_id = "";
        $this->driver_id = "";
        $this->trailer_id = [];
        $this->customer_id = "";
        $this->currency_id = "";
        $this->from = "";
        $this->to = "";
        $this->weight = "";
        $this->rate = "";
        $this->freight = "";
        $this->cargo = "";
        $this->start_date = "";
      
    }

    public function mount(){
        $this->trips = Trip::where('company_id',Auth::user()->company->id)->orderBy('created_at','desc')->get();
        $this->customers = Customer::orderBy('name','asc')->get();
        $this->drivers = Driver::orderBy('name','asc')->get();
        $this->horses = Horse::orderBy('registration_number','asc')->get();
        $this->trailers = Trailer::orderBy('registration_number','asc')->get();
        $this->currencies = Currency::orderBy('name','asc')->get();
    }

    public function updated($value){
        $this->validateOnly($value);
    }
    protected $rules = [
        'horse_id' => 'required',
        'customer_id' => 'required',
        'from' => 'required',
        'to' => 'required',
        'freight' => 'required',
        'currency_id' => 'required',
        'start_date' => 'required',
        'status' => 'required',
    ];

    public function tripNumber(){

        $str = Auth::user()->company->name;
            $words = explode(' ', $str);
            if (isset($words[1][0])) {
                $initials = $words[0][0].$words[1][0];
            }else {
                $initials = $words[0][0];
            }
 
        $trip = Trip::where('company_id', Auth::user()->company->id)->orderBy('id','desc')->get()->first();

        if (!$trip) {
            $trip_number =  $initials .'T'. str_pad(1, 5, "0", STR_PAD_LEFT);
        }else {
            $number = $trip->id + 1;
            $trip_number =  $initials .'T'. str_pad($number, 5, "0", STR_PAD_LEFT);
        }

        return  $trip_number;

    }

    public function store(){
      
        $trip =  new Trip;
        $trip->user_id = Auth::user()->id;
        $trip->company_id = Auth::user()->company_id;
        $trip->trip_number = $this->tripNumber();
        $trip->trip_ref = $this->trip_ref;
        $trip->horse_id = $this->horse_id;
        $trip->driver_id = $this->driver_id;
        $trip->customer_id = $this->customer_id;
        $trip->cargo = $this->cargo;
        $trip->from = $this->from;
        $trip->to = $this->to;
        $trip->weight = $this->weight;
        $trip->litreage = $this->litreage;
        $trip->currency_id = $this->currency_id;
        $trip->rate = $this->rate;
        $trip->freight = $this->freight;
        $trip->status = $this->status;
        $trip->start_date = $this->start_date;
        $trip->description = $this->description;
        $trip->save();
        $trip->trailers()->sync($this->trailer_id);

        $this->dispatch('hide-tripModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Trip Created Successfully!!",
            position: "center",
        );

    }

    public function edit($id){

        $trip = Trip::find($id);
        
        $this->trip_ref = $trip->trip_ref;
        $this->horse_id = $trip->horse_id;
        foreach ($trip->trailers as $trailer) {
            $this->trailer_id[] = $trailer->id;
        }
        $this->driver_id = $trip->driver_id;
        $this->from = $trip->from;
        $this->to = $trip->to;
        $this->customer_id = $trip->customer_id;
        $this->cargo = $trip->cargo;
        $this->weight = $trip->weight;
        $this->litreage = $trip->litreage;
        $this->currency_id = $trip->currency_id;
        $this->rate = $trip->rate;
        $this->freight = $trip->freight;
        $this->status = $trip->status;
        $this->start_date = $trip->start_date;
        $this->description = $trip->description;
        $this->trip_id = $trip->id;

        $this->dispatch('show-tripEditModal');
    }

    public function update(){

        $trip =  Trip::find($this->trip_id);
        $trip->trip_ref = $this->trip_ref;
        $trip->horse_id = $this->horse_id;
        $trip->driver_id = $this->driver_id;
        $trip->from = $this->from;
        $trip->to = $this->to;
        $trip->customer_id = $this->customer_id;
        $trip->cargo = $this->cargo;
        $trip->weight = $this->weight;
        $trip->litreage = $this->litreage;
        $trip->currency_id = $this->currency_id;
        $trip->rate = $this->rate;
        $trip->freight = $this->freight;
        $trip->status = $this->status;
        $trip->start_date = $this->start_date;
        $trip->description = $this->description;
        $trip->update();
        $trip->trailers()->detach();
        $trip->trailers()->sync($this->trailer_id);

        $this->dispatch('hide-tripEditModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Trip Updated Successfully!!",
            position: "center",
        );

    }

    public function delete($id){
        $trip = Trip::find($id);
        $trip->trailers()->detach();
        $trip->delete();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Trip Deleted Successfully!!",
            position: "center",
        );
    }

    public function render()
    {
      $this->trips = Trip::where('company_id',Auth::user()->company->id)->orderBy('created_at','desc')->get();
        return view('livewire.trips.index',[
        'trips' =>$this->trips
        ]);
    }
}
