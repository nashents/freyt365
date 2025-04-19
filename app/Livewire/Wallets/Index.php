<?php

namespace App\Livewire\Wallets;

use App\Models\Wallet;
use App\Models\Company;
use Livewire\Component;
use App\Models\Currency;
use App\Models\BankAccount;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $name;
    public $wallets;
    public $currencies;
    public $currency_id;
    public $description;
    public $active;
    public $wallet_id;

 

  
    public $selectedWallet;
    public $receiving_wallet_number;

    public $transactions;
    public $transaction;
    public $transaction_id;
    public $transaction_date;
    public $transaction_number;
    public $reference_code;
    public $from_bank_accounts;
    public $selectedFrom;
    public $selectedTo;
    public $to_bank_accounts;
    public $verification;
    public $verified_by_id;
    public $authorization;
    public $authorized_by_id;
    public $reason;
    public $verification_reason;
    public $selectedMop;
    public $amount;
    public $charge;
    public $transaction_types;
    public $selectedTransactionType;
    public $transaction_type;
    public $selected_transaction_type;
    public $selected_wallet;
    public $admin;

    private function resetInputFields(){
        $this->active = "" ;
        $this->currency_id = "" ;
        $this->name = "";
        $this->reference_code = "" ;
        $this->selectedWallet = "" ;
        $this->selectedMop = "";
        $this->transaction_date = "";
        $this->amount = "";
        $this->selectedFrom = "";
        $this->selectedTo = "";
        $this->selectedTransactionType = "";
        $this->authorization = "";
        $this->verification = "";
        $this->reason = "";
        $this->verification_reason = "";
    }

    public function mount(){
        $this->currencies = Currency::orderBy('name','asc')->get();
        if (Auth::user()->is_admin()) {
            $this->wallets = Wallet::orderBy('name','asc')->get();
        }else{
            $this->wallets = Wallet::where('company_id',Auth::user()->company->id)->orderBy('name','asc')->get();
        }
        $this->transaction_types = TransactionType::orderBy('name','asc')->get();
    }

    public function updatedSelectedTransactionType($id){
        if (!is_null($id)) {
            $this->selected_transaction_type = TransactionType::find($id);
        }
    }

    public function transactionNumber(){
       
        $initials = 'F365';

        $transaction = Transaction::orderBy('id','desc')->first();

        if (!$transaction) {
            $transaction_number =  $initials .'T'. str_pad(1, 5, "0", STR_PAD_LEFT);
        }else {
            $number = $transaction->id + 1;
            $transaction_number =  $initials .'T'. str_pad($number, 5, "0", STR_PAD_LEFT);
        }

        return  $transaction_number;
   


    }


    public function updatedSelectedWallet($id){
        if (!is_null($id)) {
            $wallet = Wallet::find($id);
            $this->currency_id = $wallet->currency_id;

            $this->admin = Company::where('type','admin')->first();

        }
    }

    public function loadDeposit($id){
        $this->selectedWallet = $id;
        $wallet = Wallet::find($id);
        $this->currency_id = $wallet->currency_id;
        $this->selected_transaction_type = TransactionType::where('name','Deposit')->first();
        $this->selectedTransactionType =    $this->selected_transaction_type->id;
        $this->admin = Company::where('type','admin')->first();
        if (isset($this->admin)) {
            $this->to_bank_accounts = BankAccount::where('company_id',  $this->admin->id)->where('currency_id',$this->currency_id)->orderBy('name','asc')->get();
            $this->from_bank_accounts = BankAccount::where('company_id', Auth::user()->company->id)->where('currency_id',$this->currency_id)->orderBy('name','asc')->get();
        }

        $this->dispatch('show-transactionModal');
    }

    public function deposit(){
        
        $transaction = new Transaction;
        $transaction->transaction_number = $this->transactionNumber();
        $transaction->user_id = Auth::user()->id;
        $transaction->company_id = Auth::user()->company_id;
        $transaction->wallet_id = $this->selectedWallet;
        $transaction->transaction_date = $this->transaction_date;
        $transaction->reference_code = $this->reference_code;   
        $transaction->transaction_type_id =  $this->selectedTransactionType;
        $transaction->mop = $this->selectedMop;
        $transaction->from = $this->selectedFrom;
        $transaction->to = $this->selectedTo;
        $transaction->amount = $this->amount;
        $transaction->currency_id = $this->currency_id;
        $transaction->save();

        $this->dispatch('hide-transactionModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Transaction Created Successfully!!",
            position: "center",
        );

        return redirect()->route('transactions.index');
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
        $wallet->balance = 0;
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
        $this->wallet_id = $wallet->id;
        $this->dispatch('show-walletEditModal');
       
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

    public function delete($id){
        $wallet = Wallet::find($id);
        $transactions = $wallet->transactions;
        if($transactions){
            foreach($transactions as $transaction){
                $transaction->delete();
            }
        }
        $orders = $wallet->orders;
        if($orders){
            foreach($orders as $order){
                $order->delete();
            }
        }
        $wallet->delete();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Wallet Deleted Successfully!!",
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
        $this->from_bank_accounts = BankAccount::where('company_id', Auth::user()->company->id)->orderBy('name','asc')->get();
        return view('livewire.wallets.index',[
            'currencies' => $this->currencies,
            'wallets' => $this->wallets,
            'from_bank_accounts' => $this->from_bank_accounts,
        ]);
    }
}
