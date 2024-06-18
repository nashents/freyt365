<?php

namespace App\Livewire\ClearingAgents;

use App\Models\Country;
use Livewire\Component;
use App\Models\ClearingAgent;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{

    public $clearing_agents;
    public $clearing_agent;
    public $clearing_agent_id;
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

    public function mount(){
        $this->clearing_agents = ClearingAgent::orderBy('name','asc')->get();
        $this->countries = Country::orderBy('name','asc')->get();
    }

    private function resetInputFields(){
        $this->name = "" ;
        $this->surname = "" ;
        $this->email = "";
        $this->phonenumber = "";
        $this->country_id = "";
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
        
        $clearing_agent = new ClearingAgent;
        $clearing_agent->user_id = Auth::user()->id;
        $clearing_agent->name = $this->name;
        $clearing_agent->surname = $this->surname;
        $clearing_agent->email = $this->email;
        $clearing_agent->phonenumber = $this->phonenumber;
        $clearing_agent->country_id = $this->country_id;
        $clearing_agent->city = $this->city;
        $clearing_agent->suburb = $this->suburb;
        $clearing_agent->street_address = $this->street_address;
        $clearing_agent->save();

        $this->dispatch('hide-clearing_agentModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Clearing Agent Created Successfully!!",
            position: "center",
        );
    }

    public function edit($id){
        $clearing_agent = ClearingAgent::find($id);
        $this->name = $clearing_agent->name;
        $this->surname = $clearing_agent->surname;
        $this->email = $clearing_agent->email;
        $this->phonenumber = $clearing_agent->phonenumber;
        $this->country_id = $clearing_agent->country_id;
        $this->city = $clearing_agent->city;
        $this->suburb = $clearing_agent->suburb;
        $this->street_address = $clearing_agent->street_address;
        $this->status = $clearing_agent->status;
        $this->clearing_agent_id = $clearing_agent->id;

        $this->dispatch('show-clearing_agentEditModal');
    }

    public function update(){

        $clearing_agent = ClearingAgent::find($this->clearing_agent_id);
        $clearing_agent->user_id = Auth::user()->id;
        $clearing_agent->name = $this->name;
        $clearing_agent->surname = $this->surname;
        $clearing_agent->email = $this->email;
        $clearing_agent->phonenumber = $this->phonenumber;
        $clearing_agent->country_id = $this->country_id;
        $clearing_agent->city = $this->city;
        $clearing_agent->suburb = $this->suburb;
        $clearing_agent->street_address = $this->street_address;
        $clearing_agent->update();

        $this->dispatch('hide-clearing_agentEditModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Clearing Agent Updated Successfully!!",
            position: "center",
        );
    }


    public function delete($id){
        $clearing_agent = ClearingAgent::find($id);
        $clearing_agent->delete();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Clearing Agent Deleted Successfully!!",
            position: "center",
        );
    }

    public function render()
    {
        $this->clearing_agents = ClearingAgent::orderBy('name','asc')->get();
        return view('livewire.clearing-agents.index',[
            'clearing_agents' => $this->clearing_agents
        ]);
    }
}
