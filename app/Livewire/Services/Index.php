<?php

namespace App\Livewire\Services;

use App\Models\Service;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $services;
    public $service;
    public $service_id;
    public $name;

    public function mount(){
        $this->services = Service::orderBy('name','asc')->get();
    }

    private function resetInputFields(){
      
        $this->name = "";
    }

    public function store(){
        $service = new Service;
        $service->user_id = Auth::user()->id;
        $service->name = $this->name;
        $service->save();

        $this->dispatch('hide-serviceModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Service Created Successfully!!",
            position: "center",
        );
    }

    public function edit($id){
        $service = service::find($id);
        $this->name = $service->name;
        $this->service_id = $service->id;

        $this->dispatch('show-serviceEditModal');
    }

    public function update(){
        $service =  Service::find($this->service_id);
        $service->name = $this->name;
        $service->update();

        $this->dispatch('hide-serviceEditModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Service Updated Successfully!!",
            position: "center",
        );
    }

    public function delete($id){
        
        $service = Service::find($id);
        $service->delete();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Service Deleted Successfully!!",
            position: "center",
        );
    }

    public function render()
    {
        $this->services = Service::orderBy('name','asc')->get();
        return view('livewire.services.index',[
            'services' => $this->services
        ]);
    }
}
