<?php

namespace App\Livewire\Drivers;

use App\Models\Driver;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $drivers;
    public $driver_id;
    public $name;
    public $surname;
    public $license_number;
    public $passport_number;
    public $gender;
    public $dob;
    public $phonenumber;
    public $status;
  

    private function resetInputFields(){
        $this->name = "" ;
        $this->surname = "";
        $this->license_number = "";
        $this->passport_number = "";
        $this->gender = "";
        $this->dob = "";
        $this->phonenumber = "";
      
    }

    public function mount(){
        $this->drivers = Driver::where('company_id', Auth::user()->company_id)->orderBy('name','asc')->get();
    }

    public function updated($value){
        $this->validateOnly($value);
    }
    protected $rules = [
        'name' => 'required',
        'surname' => 'required',
        'passport_number' => 'required',
        'license_number' => 'required',
        'phonenumber' => 'required',
        'gender' => 'required',
        'dob' => 'required',
    ];

    public function store(){
        try{
    
        $driver = new Driver;
        $driver->user_id = Auth::user()->id;
        $driver->company_id = Auth::user()->company_id;
        $driver->name = $this->name;
        $driver->surname = $this->surname;
        $driver->passport_number = $this->passport_number;
        $driver->license_number = $this->license_number;
        $driver->phonenumber = $this->phonenumber;
        $driver->gender = $this->gender;
        $driver->dob = $this->dob;
        $driver->save();
        $this->dispatch('hide-driverModal');
        $this->resetInputFields();
        $this->dispatch('alert',[
            'type'=>'success',
            'message'=>"Driver Created Successfully!!"
        ]);

    }catch(\Exception $e){
        // Set Flash Message
        $this->dispatch('alert',[
            'type'=>'error',
            'message'=>"Something went wrong while creating driver!!"
        ]);
    }
    }

    public function edit($id){
       
        $driver = Driver::find($id);
        $this->name = $driver->name;
        $this->surname = $driver->surname;
        $this->license_number = $driver->license_number;
        $this->passport_number = $driver->passport_number;
        $this->phonenumber = $driver->phonenumber;
        $this->gender = $driver->gender;
        $this->dob = $driver->dob;
        $this->status = $driver->status;
        $this->driver_id = $driver->id;

        $this->dispatch('show-driverEditModal');
    }

    public function update(){
        try{

        $driver =  Driver::find($this->driver_id);
        $driver->name = $this->name;
        $driver->surname = $this->surname;
        $driver->passport_number = $this->passport_number;
        $driver->license_number = $this->license_number;
        $driver->phonenumber = $this->phonenumber;
        $driver->gender = $this->gender;
        $driver->dob = $this->dob;
        $driver->update();

        $this->dispatch('hide-driverEditModal');
        $this->resetInputFields();
        $this->dispatch('alert',[
            'type'=>'success',
            'message'=>"Driver Created Successfully!!"
        ]);

    }catch(\Exception $e){
        // Set Flash Message
        $this->dispatch('alert',[
            'type'=>'error',
            'message'=>"Something went wrong while creating driver!!"
        ]);
    }
    }

    public function render()
    {
        $this->drivers = Driver::where('company_id', Auth::user()->company_id)->orderBy('name','asc')->get();
        return view('livewire.drivers.index',[
            'drivers' => $this->drivers
        ]);
    }
}
