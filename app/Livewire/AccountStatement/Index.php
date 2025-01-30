<?php

namespace App\Livewire\AccountStatement;

use App\Models\Wallet;
use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{

    public $transactions;
    public $wallet;
    public $wallet_id;
    public $wallets;
    public $from;
    public $to;

    public function mount(){
       

        if (Auth::user()->is_admin()) {
            $this->wallets = Wallet::orderBy('name','asc')->get();
        }else{
            $this->wallets = Wallet::where('company_id',Auth::user()->company->id)->orderBy('name','asc')->get();
        }

        $this->transactions = Transaction::where('authorization','approved')->where('verification','verified')->orderBy('created_at','desc')->get();
    }

    public function render()
    {
        return view('livewire.account-statement.index');
    }
}
