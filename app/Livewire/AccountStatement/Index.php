<?php

namespace App\Livewire\AccountStatement;

use App\Models\Wallet;
use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{

    public $transactions;
    public $selected_wallet;
    public $selectedWallet;
    public $wallets;
    public $from;
    public $to;

    public function mount(){
       

        if (Auth::user()->is_admin()) {
            $this->wallets = Wallet::orderBy('name','asc')->get();
            $this->transactions = Transaction::where('authorization','approved')->where('verification','verified')->orderBy('created_at','desc')->get();
        }else{
            $this->wallets = Wallet::where('company_id',Auth::user()->company->id)->orderBy('name','asc')->get();
            $this->transactions = Transaction::where('company_id',Auth::user()->company->id)->where('authorization','approved')->where('verification','verified')->orderBy('created_at','desc')->get();
        }

       
    }

    public function updatedSelectedWallet($id){
        if (!is_null($id)) {
           $this->selected_wallet = Wallet::find($id);
           if (Auth::user()->is_admin()) {
            $this->transactions = Transaction::where('wallet_id',$id)->where('authorization','approved')->where('verification','verified')->where('status',True)->orderBy('created_at','desc')->get();
            }else{
                $this->transactions = Transaction::where('wallet_id',$id)->where('company_id',Auth::user()->company->id)->where('authorization','approved')->where('verification','verified')->where('status',True)->orderBy('created_at','desc')->get();
            }
        }
    }

    public function search(){
        if (filled($this->from) && filled($this->to) ) {
            if (isset($this->selectedWallet)) {
                if (Auth::user()->is_admin()) {
                    $this->transactions = Transaction::where('wallet_id',$this->selectedWallet)->where('authorization','approved')->where('verification','verified')->whereBetween('created_at',[$this->from, $this->to])->where('status',True)->orderBy('created_at','desc')->get();
                }else{
                    $this->transactions = Transaction::where('wallet_id',$this->selectedWallet)->where('company_id',Auth::user()->company->id)->where('authorization','approved')->where('verification','verified')->whereBetween('created_at',[$this->from, $this->to])->where('status',True)->orderBy('created_at','desc')->get();
                }
            }else{
                if (Auth::user()->is_admin()) {
                    $this->transactions = Transaction::where('authorization','approved')->where('verification','verified')->whereBetween('created_at',[$this->from, $this->to])->where('status',True)->orderBy('created_at','desc')->get();
                }else{
                    $this->transactions = Transaction::wherewhere('company_id',Auth::user()->company->id)->where('authorization','approved')->where('verification','verified')->whereBetween('created_at',[$this->from, $this->to])->where('status',True)->orderBy('created_at','desc')->get();
                }
            }
        }
    }

    public function clearValues(){
        redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.account-statement.index');
    }
}
