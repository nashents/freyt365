<?php

namespace App\Livewire\AccountStatement;

use Carbon\Carbon;
use App\Models\Wallet;
use Livewire\Component;
use App\Models\Transaction;
use App\Exports\TransactionsExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{

    public $transactions;
    public $selected_wallet;
    public $selectedWallet;
    public $wallets;
    public $from;
    public $to;


    public function exportTransactionsExcel(){
        return Excel::download(new TransactionsExport($this->from, $this->to, $this->selected_wallet), 'account_statement_' . time() . '.xlsx');
    }

    public function mount($wallet){
        $this->selectedWallet = $wallet->id;
        $this->selected_wallet = $wallet;
        $this->from = Carbon::now()->startOfMonth()->toDateString();
        $this->to = Carbon::now()->toDateString();
        if (Auth::user()->is_admin()) {
            $this->wallets = Wallet::orderBy('name','asc')->get();
            $this->transactions = Transaction::where('wallet_id',$wallet->id)->whereBetween('created_at',[$this->from, $this->to])->where('authorization','approved')->where('verification','verified')->where('status',True)->orderBy('created_at','desc')->get();
        }else{
            $this->wallets = Wallet::where('company_id',Auth::user()->company->id)->orderBy('name','asc')->get();
            $this->transactions = Transaction::where('wallet_id',$wallet->id)->whereBetween('created_at',[$this->from, $this->to])->where('company_id',Auth::user()->company->id)->where('authorization','approved')->where('status',True)->where('verification','verified')->orderBy('created_at','desc')->get();
        }

       
    }

    public function updatedSelectedWallet($id){
        if (!is_null($id)) {
           $this->selected_wallet = Wallet::find($id);
           if (Auth::user()->is_admin()) {
            $this->transactions = Transaction::where('wallet_id',$id)->whereBetween('created_at',[$this->from, $this->to])->where('authorization','approved')->where('verification','verified')->where('status',True)->orderBy('created_at','desc')->get();
            }else{
                $this->transactions = Transaction::where('wallet_id',$id)->whereBetween('created_at',[$this->from, $this->to])->where('company_id',Auth::user()->company->id)->where('authorization','approved')->where('verification','verified')->where('status',True)->orderBy('created_at','desc')->get();
            }
        }
    }

    public function search(){

        if (filled($this->from) && filled($this->to) ) {

            if ($this->selectedWallet) {
                if (Auth::user()->is_admin()) {
                    $this->transactions = Transaction::where('wallet_id',$this->selectedWallet)->where('authorization','approved')->where('verification','verified')->whereBetween('created_at',[$this->from, $this->to])->where('status',True)->orderBy('created_at','desc')->get();
                }else{
                    $this->transactions = Transaction::where('wallet_id',$this->selectedWallet)->where('company_id',Auth::user()->company->id)->where('authorization','approved')->where('verification','verified')->whereBetween('created_at',[$this->from, $this->to])->where('status',True)->orderBy('created_at','desc')->get();
                }
            }
        }
    }

   

    public function render()
    {
        return view('livewire.account-statement.index');
    }
}
