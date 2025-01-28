<?php

namespace App\Livewire\Wallets;

use App\Models\Wallet;
use Livewire\Component;
use App\Models\Currency;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $name;
    public $wallets;
    public $currencies;
    public $currency_id;
    public $description;
    public $active;

    private function resetInputFields(){
        $this->active = "" ;
        $this->currency_id = "" ;
        $this->name = "";
    }

    public function mount(){
        $this->currencies = Currency::orderBy('name','asc')->get();
        if (Auth::user()->is_admin()) {
            $this->wallets = Wallet::orderBy('name','asc')->get();
        }else{
            $this->wallets = Wallet::where('company_id',Auth::user()->company->id)->orderBy('name','asc')->get();
        }
        
    }


    public function walletNumber(){

        $initials = 'F365';

            $wallet = Wallet::orderBy('id','desc')->first();

        if (!$wallet) {
            $wallet_number =  $initials .'W'. str_pad(1, 5, "0", STR_PAD_LEFT);
        }else {
            $number = $wallet->id + 1;
            $wallet_number =  $initials .'W'. str_pad($number, 5, "0", STR_PAD_LEFT);
        }

        return  $wallet_number;


    }

    

    public function store(){
       
        $wallet = new Wallet;
        $wallet->company_id = Auth::user()->company_id;
        $wallet->name = $this->name;
        $wallet->wallet_number = $this->walletNumber();
        $wallet->currency_id = $this->currency_id;
        $wallet->active = $this->active;
        $wallet->save();

        $this->dispatch('hide-walletModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Wallet Added Successfully!!",
            position: "center",
        );
    }

    public function edit($id){
        $wallet = Wallet::find($id);
        $this->name = $wallet->name;
        $this->currency_id = $wallet->currency_id;
        $this->active = $wallet->active;

        $this->dispatch('hide-userEditModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "User Updated Successfully!!",
            position: "center",
        );
    }
   
    public function update(){
        $wallet = Wallet::find($this->wallet_id);
        $wallet->name = $this->name;
        $wallet->currency_id = $this->currency_id;
        $wallet->active = $this->active;
        $wallet->update();

        $this->dispatch('hide-walletEditModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Wallet Updated Successfully!!",
            position: "center",
        );
    }

    public function render()
    {
        $this->currencies = Currency::orderBy('name','asc')->get();
        if (Auth::user()->is_admin()) {
            $this->wallets = Wallet::orderBy('name','asc')->get();
        }else{
            $this->wallets = Wallet::where('company_id',Auth::user()->company->id)->orderBy('name','asc')->get();
        }
        return view('livewire.wallets.index',[
            'currencies' => $this->currencies,
            'wallets' => $this->wallets,
        ]);
    }
}
