<?php

namespace App\Livewire\Transactions;

use Livewire\Component;
use App\Models\Currency;
use App\Models\BankAccount;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{

    public $currencies;
    public $currency_id;
    public $transactions;
    public $transaction_id;
    public $transaction_date;
    public $transaction_number;
    public $reference_code;
    public $from_bank_accounts;
    public $from;
    public $to;
    public $to_bank_accounts;
    public $verification;
    public $verified_by_id;
    public $authorization;
    public $authorized_by_id;
    public $reason;
    public $verification_reason;
    public $mop;
    public $amount;
    public $type;

    public function mount(){

        $this->to_bank_accounts = BankAccount::where('company_id', 1)->orderBy('name','asc')->get();
        $this->from_bank_accounts = BankAccount::where('company_id', Auth::user()->company->id)->orderBy('name','asc')->get();
        $this->currencies = Currency::orderBy('name','asc')->get();
        $this->transactions = Transaction::orderBy('created_at','desc')->get();

    }

    private function resetInputFields(){
        $this->reference_code = "" ;
        $this->currency_id = "" ;
        $this->mop = "";
        $this->transaction_date = "";
        $this->amount = "";
        $this->from = "";
        $this->to = "";
        $this->type = "";
    }

    public function transactionNumber(){
       
        if (isset(Auth::user()->company)) {
            $str = Auth::user()->company->name;
            $words = explode(' ', $str);
            if (isset($words[1][0])) {
                $initials = $words[0][0].$words[1][0];
            }else {
                $initials = $words[0][0];
            }
        }

            $transaction = Transaction::orderBy('id', 'desc')->first();

        if (!$transaction) {
            $transaction_number =  $initials .'T'. str_pad(1, 5, "0", STR_PAD_LEFT);
        }else {
            $number = $transaction->id + 1;
            $transaction_number =  $initials .'T'. str_pad($number, 5, "0", STR_PAD_LEFT);
        }

        return  $transaction_number;

   


    }

    public function updated($value){
        $this->validateOnly($value);
    }
    protected $rules = [
        'amount' => 'required',
        'currency_id' => 'required',
        'type' => 'required',
        'mop' => 'required',
        'transaction_date' => 'required',
        'to' => 'required',
    ];

    public function store(){

        try{

        $transaction = new Transaction;
        $transaction->transaction_number = $this->transactionNumber();
        $transaction->user_id = Auth::user()->id;
        $transaction->wallet_id = Auth::user()->company->wallet ? Auth::user()->company->wallet->id : Null;
        $transaction->transaction_date = $this->transaction_date;
        $transaction->reference_code = $this->reference_code;
        $transaction->type = $this->type;
        $transaction->mop = $this->mop;
        $transaction->from = $this->from;
        $transaction->to = $this->to;
        $transaction->amount = $this->amount;
        $transaction->currency_id = $this->currency_id;
        $transaction->save();

        $this->dispatch('hide-transactionModal');
        $this->resetInputFields();
        $this->dispatch('alert',[
            'type'=>'success',
            'message'=>"Transaction Recorded Successfully!!"
        ]);

    }catch(\Exception $e){
        // Set Flash Message
        $this->dispatch('alert',[
            'type'=>'error',
            'message'=>"Something went wrong while creating transaction!!"
        ]);
    }
      
    }

    public function render()
    {
        $this->from_bank_accounts = BankAccount::where('company_id', Auth::user()->company->id)->orderBy('name','asc')->get();
        return view('livewire.transactions.index',[
            'from_bank_accounts' => $this->from_bank_accounts
        ]);
    }
}
