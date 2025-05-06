<?php

namespace App\Livewire\HorseMakes;

use Livewire\Component;
use App\Models\HorseMake;
use App\Models\HorseModel;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $makes;
    public $name;
    public $make_id;
    public $model_name;
    public $models;
   
    public function mount(){
    }

    private function resetInputFields(){
        $this->name = "";
    }

    public function store(){
        $make = new HorseMake;
        $make->user_id = Auth::user()->id;
        $make->name = $this->name;
        $make->save();

        $this->dispatch('hide-makeModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Horse Make Created Successfully!!",
            position: "center",
        );
    }

    public function edit($id){
        $make = HorseMake::find($id);
        $this->name = $make->name;
        $this->make_id = $make->id;

        $this->dispatch('show-makeEditModal');
    }

    public function update(){
        $make =  HorseMake::find($this->make_id);
        $make->name = $this->name;
        $make->update();

        $this->dispatch('hide-makeEditModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Horse Make Updated Successfully!!",
            position: "center",
        );
    }

    public function delete($id){
        
        $make = HorseMake::find($id);
        $models = $make->horse_models;
        if ($models) {
            foreach ($models as $model) {
                $model->delete();
            }
        }
        $make->delete();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Horse Make Deleted Successfully!!",
            position: "center",
        );
    }

    public function storeModel(){
        $model = new HorseModel;
        $model->user_id = Auth::user()->id;
        $model->name = $this->name;
        $model->horse_make_id = $this->make_id;
        $model->save();

        $this->dispatch('hide-modelModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Horse Model Created Successfully!!",
            position: "center",
        );
    }

    public function editModel($id){
        $model = HorseModel::find($id);
        $this->name = $model->name;
        $this->make_id = $model->horse_make_id;
        $this->model_id = $model->id;

        $this->dispatch('show-modelEditModal');
    }

    public function updateModel(){
        $model =  HorseModel::find($this->model_id);
        $model->horse_make_id = $this->make_id;
        $model->name = $this->name;
        $model->update();

        $this->dispatch('hide-modelEditModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Horse Model Updated Successfully!!",
            position: "center",
        );
    }

    public function deleteModel($id){
        
        $model = HorseModel::find($id);
        $model->delete();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Horse Model Deleted Successfully!!",
            position: "center",
        );
    }

    public function render()
    {
        $this->makes = HorseMake::orderBy('name','asc')->get();
        return view('livewire.horse-makes.index',[
            'makes' => $this->makes
        ]);
    }
}
