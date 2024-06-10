<?php

namespace App\Livewire\Charges;

use App\Models\Charge;
use Livewire\Component;
use App\Models\TransactionType;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{

    public $charges;
    public $charge;
    public $charge_id;
    public $transaction_types;
    public $transaction_type;
    public $transaction_type_id;
    public $percentage;

    public function mount(){
        $this->charges = Charge::all();
        $this->transaction_types = TransactionType::all();
    }

    private function resetInputFields(){
      
        $this->percentage = "";
        $this->transaction_type_id = "";
    }

    public function store(){
        $charge = new Charge;
        $charge->user_id = Auth::user()->id;
        $charge->transaction_type_id = $this->transaction_type_id;
        $charge->percentage = $this->percentage;
        $charge->save();

        $this->dispatch('hide-chargeModal');
        $this->resetInputFields();
        $this->dispatch('alert',[
            'type'=>'success',
            'message'=>"Transaction Charge Created Successfully!!"
        ]);
    }

    public function edit($id){
        $charge = Charge::find($id);
        $this->transaction_type_id = $charge->transaction_type_id;
        $this->percentage = $charge->percentage;
        $this->charge_id = $charge->id;

        $this->dispatch('show-chargeEditModal');
    }

    public function update(){
        $charge =  Charge::find($this->charge_id);
        $charge->transaction_type_id = $this->transaction_type_id;
        $charge->percentage = $this->percentage;
        $charge->update();

        $this->dispatch('hide-chargeEditModal');
        $this->resetInputFields();
        $this->dispatch('alert',[
            'type'=>'success',
            'message'=>"Transaction Charge Updated Successfully!!"
        ]);
    }

    public function delete($id){
        
        $charge = Charge::find($id);
        $charge->delete();
        $this->dispatch('alert',[
            'type'=>'success',
            'message'=>"Transaction Charge Deleted Successfully!!"
        ]);
    }

    public function render()
    {
        $this->charges = Charge::all();
        return view('livewire.charges.index',[
            'charges' => $this->charges
        ]);
    }
}
