<?php

namespace App\Livewire\Currencies;

use Livewire\Component;
use App\Models\Currency;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{

    public $currencies;
    public $currency;
    public $currency_id;
    public $fullname;
    public $name;
    public $symbol;


    private function resetInputFields(){
        $this->fullname = "" ;
        $this->name = "";
        $this->symbol = "";
    }

    public function mount(){
        $this->currencies = Currency::orderBy('name')->get();
    }

    public function store(){

        $currency = new Currency;
        $currency->user_id = Auth::user()->id;
        $currency->fullname = $this->fullname;
        $currency->name = $this->name;
        $currency->symbol = $this->symbol;
        $currency->save();

        $this->dispatch('hide-currencyModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Currency Added Successfully!!",
            position: "center",
        );

    }

    public function edit($id){
        $currency = Currency::find($id);
        $this->currency_id = $id ;
        $this->fullname = $currency->fullname ;
        $this->name = $currency->name ;
        $this->symbol = $currency->symbol ;

        $this->dispatch('show-currencyEditModal');
    }

    public function update(){

        $currency = Currency::find($this->currency_id);
        $currency->fullname = $this->fullname;
        $currency->name = $this->name;
        $currency->symbol = $this->symbol;
        $currency->update();

        $this->dispatch('hide-currencyEditModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Currency Updated Successfully!!",
            position: "center",
        );

    }
    
    public function delete($id){
        $currency = Currency::find($id);
        $currency->delete();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Currency Deleted Successfully!!",
            position: "center",
        );
    }

    public function render()
    {
        $this->currencies = Currency::orderBy('name')->get();
        return view('livewire.currencies.index',[
            'currencies' =>   $this->currencies
        ]);
    }
}
