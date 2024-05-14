<?php

namespace App\Livewire\Horses;

use App\Models\Horse;
use App\Models\Trailer;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{

    public $horses;
    public $horse_id;
    public $make;
    public $model;
    public $registration_number;
    public $fleet_number;
    public $registration_date;
    public $trailer_id = [];
    public $trailers;
    public $status;
    public $color;

    public $inputs = [];
    public $i = 1;
    public $n = 1;

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs ,$i);
    }

   

    public function remove()
    {
        $this->inputs = [];
        // unset($this->inputs[$i]);
    }

    private function resetInputFields(){
        $this->make = "" ;
        $this->model = "" ;
        $this->company_id = "" ;
        $this->registration_date = "" ;
        $this->registration_number = "" ;
        $this->fleet_number = "";
        $this->trailer_id = [];
      
    }

    public function mount(){
        $this->horses = Horse::where('company_id', Auth::user()->company_id)->orderBy('registration_number','asc')->get();
        $this->trailers = Trailer::where('company_id', Auth::user()->company_id)->orderBy('registration_number','asc')->get();
    }

    public function updated($value){
        $this->validateOnly($value);
    }
    protected $rules = [
        'registration_number' => 'required',
        'registration_date' => 'required',
        'color' => 'required',
        'make' => 'required',
        'model' => 'required',
    ];

    public function store(){
        try{
        $horse = new Horse;
        $horse->user_id = Auth::user()->id;
        $horse->company_id = Auth::user()->company_id;
        $horse->registration_number = $this->registration_number;
        $horse->registration_date = $this->registration_date;
        $horse->fleet_number = $this->fleet_number;
        $horse->color = $this->color;
        $horse->make = $this->make;
        $horse->model = $this->model;
        $horse->save();

        $horse->trailers()->attach($this->trailer_id);

        $this->dispatch('hide-horseModal');
        $this->resetInputFields();
        $this->dispatch('alert',[
            'type'=>'success',
            'message'=>"Horse Created Successfully!!"
        ]);

    }catch(\Exception $e){
        // Set Flash Message
        $this->dispatch('alert',[
            'type'=>'error',
            'message'=>"Something went wrong while creating horse!!"
        ]);
    }
    }

    public function edit($id){
       
        $horse = Horse::find($id);
        $this->registration_number = $horse->registration_number;
        $this->registration_date = $horse->registration_date;
        $this->fleet_number = $horse->fleet_number;
        $this->color = $horse->color;
        $this->make = $horse->make;
        $this->model = $horse->model;
        $horse_trailers = $horse->trailers;
            foreach ($horse_trailers as $trailer) {
                $this->trailer_id[] = $trailer->id;
            }
        $this->status = $horse->status;
        $this->horse_id = $horse->id;

        $this->dispatch('show-horseEditModal');
    }

    public function update(){
        try{

        $horse =  Horse::find($this->horse_id);
        $horse->registration_number = $this->registration_number;
        $horse->registration_date = $this->registration_date;
        $horse->fleet_number = $this->fleet_number;
        $horse->color = $this->color;
        $horse->make = $this->make;
        $horse->model = $this->model;
        $horse->update();
        $horse->trailers()->detach();
        $horse->trailers()->sync($this->trailer_id);

        $this->dispatch('hide-horseEditModal');
        $this->resetInputFields();
        $this->dispatch('alert',[
            'type'=>'success',
            'message'=>"Horse Updated Successfully!!"
        ]);

    }catch(\Exception $e){
        // Set Flash Message
        $this->dispatch('alert',[
            'type'=>'error',
            'message'=>"Something went wrong while updating horse!!"
        ]);
    }
    }


    public function delete($id){
        $horse = Horse::find($id);
        $trailers = $horse->trailers;
        if (isset($trailers)) {
            $horse->trailers->detach();
        }
        $horse->delete();
        $this->dispatch('alert',[
            'type'=>'success',
            'message'=>"Horse Deleted Successfully!!"
        ]);
    }

    public function render()
    {
        $this->horses = Horse::where('company_id', Auth::user()->company_id)->orderBy('registration_number','asc')->get();
        return view('livewire.horses.index',[
            'horses' => $this->horses
        ]);
    }
}
