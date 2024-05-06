<?php

namespace App\Livewire\Trailers;

use App\Models\Trailer;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $trailers;
    public $trailer_id;
    public $registration_number;
    public $fleet_number;
    public $status;
  

    private function resetInputFields(){
        $this->registration_number = "" ;
        $this->fleet_number = "";
      
    }

    public function mount(){
        $this->trailers = Trailer::where('company_id', Auth::user()->company_id)->orderBy('registration_number','asc')->get();
    }

    public function updated($value){
        $this->validateOnly($value);
    }
    protected $rules = [
        'registration_number' => 'required',
    ];

    public function store(){
        try{
    
        $trailer = new Trailer;
        $trailer->user_id = Auth::user()->id;
        $trailer->company_id = Auth::user()->company_id;
        $trailer->registration_number = $this->registration_number;
        $trailer->fleet_number = $this->fleet_number;
        $trailer->save();
        $this->dispatch('hide-trailerModal');
        $this->resetInputFields();
        $this->dispatch('alert',[
            'type'=>'success',
            'message'=>"Trailer Created Successfully!!"
        ]);

    }catch(\Exception $e){
        // Set Flash Message
        $this->dispatch('alert',[
            'type'=>'error',
            'message'=>"Something went wrong while creating trailer!!"
        ]);
    }
    }

    public function edit($id){
       
        $trailer = Trailer::find($id);
        $this->registration_number = $trailer->registration_number;
        $this->fleet_number = $trailer->fleet_number;
        $this->status = $trailer->status;
        $this->trailer_id = $trailer->id;

        $this->dispatch('show-trailerEditModal');
    }

    public function update(){
        try{

        $trailer =  Trailer::find($this->trailer_id);
        $trailer->registration_number = $this->registration_number;
        $trailer->fleet_number = $this->fleet_number;
        $trailer->update();

        $this->dispatch('hide-trailerEditModal');
        $this->resetInputFields();
        $this->dispatch('alert',[
            'type'=>'success',
            'message'=>"Trailer Created Successfully!!"
        ]);

    }catch(\Exception $e){
        // Set Flash Message
        $this->dispatch('alert',[
            'type'=>'error',
            'message'=>"Something went wrong while creating trailer!!"
        ]);
    }
    }

    public function render()
    {
        $this->trailers = Trailer::where('company_id', Auth::user()->company_id)->orderBy('registration_number','asc')->get();
        return view('livewire.trailers.index',[
            'trailers' => $this->trailers
        ]);
    }
}
