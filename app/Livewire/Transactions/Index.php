<?php

namespace App\Livewire\Transactions;

use Livewire\Component;
use App\Models\Currency;
use App\Models\BankAccount;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{

    public $currencies;
    public $currency_id;
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
    public $mop;
    public $amount;
    public $selectedType;
    public $charge;
    public $transaction_types;
    public $transaction_type_id;
    public $transaction_type;
    public $wallet_balance;
    public $wallet;
    public $wallet_id;

    public function mount(){
       

        $this->currencies = Currency::orderBy('name','asc')->get();
        $this->transaction_types = TransactionType::orderBy('name','asc')->get();
        if (Auth::user()->is_admin || Auth::user()->company->type == "admin") {
            $this->transactions = Transaction::orderBy('created_at','desc')->get();

        }else {
            $this->transactions = Transaction::where('company_id', Auth::user()->company->id)->orderBy('created_at','desc')->get();

        }

        $this->wallet = Auth::user()->company->wallet;

        if (isset($this->wallet)) {
            $this->currency_id = $this->wallet->currency_id;
            $this->to_bank_accounts = BankAccount::where('company_id', 1)->where('currency_id',$this->wallet->currency_id)->orderBy('name','asc')->get();
            $this->from_bank_accounts = BankAccount::where('company_id', Auth::user()->company->id)->where('currency_id',$this->wallet->currency_id)->orderBy('name','asc')->get();
        }else{
            $this->to_bank_accounts = BankAccount::where('company_id', 1)->orderBy('name','asc')->get();
            $this->from_bank_accounts = BankAccount::where('company_id', Auth::user()->company->id)->orderBy('name','asc')->get();
        }

       
       
    }

    public function updatedSelectedType($type){
            if (!is_null($type)) {
                if ($type == "Withdrawal") {
                    $this->wallet_balance = $this->wallet->balance;
                }
            }
    }

    private function resetInputFields(){
        $this->reference_code = "" ;
        $this->currency_id = "" ;
        $this->mop = "";
        $this->transaction_date = "";
        $this->amount = "";
        $this->selectedFrom = "";
        $this->selectedTo = "";
        $this->selectedType = "";
        $this->authorization = "";
        $this->verification = "";
        $this->reason = "";
        $this->verification_reason = "";
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
        'selectedType' => 'required',
        'mop' => 'required',
        'transaction_date' => 'required',
        'selectedTo' => 'required',
    ];

    public function store(){

        try{

        $transaction = new Transaction;
        $transaction->transaction_number = $this->transactionNumber();
        $transaction->user_id = Auth::user()->id;
        $transaction->wallet_id = Auth::user()->company->wallet ? Auth::user()->company->wallet->id : Null;
        $transaction->transaction_date = $this->transaction_date;
        $transaction->reference_code = $this->reference_code;   
        $this->transaction_type = TransactionType::where('name',$this->selectedType)->first();
        if (isset($this->transaction_type)) {
            $transaction->transaction_type_id =  $this->transaction_type->id;
        }   
        $transaction->mop = $this->mop;
        $transaction->from = $this->selectedFrom;
        $transaction->to = $this->selectedTo;
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


    public function edit($id){
       
        $transaction = Transaction::find($id);
        $this->mop = $transaction->mop;
        $this->reference_code = $transaction->reference_code;
        $this->transaction_type = TransactionType::find($transaction->transaction_type_id);
        if (isset($this->transaction_type)) {
            $this->selectedType = $this->transaction_type->name;
        }
        $this->selectedFrom = $transaction->from;
        $this->selectedTo = $transaction->to;
        $this->amount = $transaction->amount;
        $this->currency_id = $transaction->currency_id;
        $this->transaction_date = $transaction->transaction_date;
        $this->transaction_id = $id;
        $this->dispatch('show-transactionEditModal');

    }

    public function update(){

        try{

        $transaction =  Transaction::find($this->transaction_id);
        $transaction->transaction_date = $this->transaction_date;
        $transaction->reference_code = $this->reference_code;
        $this->transaction_type = TransactionType::where('name',$this->selectedType)->first();
        if (isset($this->transaction_type)) {
            $transaction->transaction_type_id =  $this->transaction_type->id;
        }
        $transaction->mop = $this->mop;
        $transaction->from = $this->selectedFrom;
        $transaction->to = $this->selectedTo;
        $transaction->amount = $this->amount;
        $transaction->currency_id = $this->currency_id;
        $transaction->update();

        $this->dispatch('hide-transactionEditModal');
        $this->resetInputFields();
        $this->dispatch('alert',[
            'type'=>'success',
            'message'=>"Transaction Updated Successfully!!"
        ]);

    }catch(\Exception $e){
        // Set Flash Message
        $this->dispatch('alert',[
            'type'=>'error',
            'message'=>"Something went wrong while creating transaction!!"
        ]);
    }
      
    }

    public function showAuthorize($id){
        $this->transaction_id = $id;
        $this->transaction = Transaction::find($id);
        $this->dispatch('show-authorizationModal');
    }

    public function saveAuthorize(){

        $transaction = Transaction::find($this->transaction_id);
        $transaction->authorized_by_id = Auth::user()->id;
        $transaction->authorization = $this->authorization;
        $transaction->reason = $this->reason;
        $transaction->update();

        if ($this->authorization == "approved") {
            $this->dispatch('hide-authorizationModal');
            $this->resetInputFields();
            $this->dispatch('alert',[
                'type'=>'success',
                'message'=>"Transaction Approved Successfully!!"
            ]);
        }else {
            $this->dispatch('hide-authorizationModal');
            $this->resetInputFields();
            $this->dispatch('alert',[
                'type'=>'success',
                'message'=>"Transaction Rejected Successfully!!"
            ]);
        }

      
      
        
    }

  

    public function showVerify($id){
        $this->transaction_id = $id;
        $this->transaction = Transaction::find($id);
        $this->dispatch('show-verificationModal');
    }

    public function saveVerify(){

        $transaction = Transaction::find($this->transaction_id);
        $transaction->verified_by_id = Auth::user()->id;
        $transaction->verification = $this->verification;
        $transaction->verification_reason = $this->reason;
        $transaction_type = TransactionType::find($transaction->transaction_type_id);

        if (isset($transaction_type)) {
            $charge = $transaction_type->charge;
            if (isset($charge)) {
                if (isset($charge->percentage) && isset($transaction->amount)) {
                    $this->charge_amount = ($charge->percentage/100) * $transaction->amount;
                    $transaction->charge = $charge->percentage;
                    $transaction->charge_amount = $this->charge_amount;
                }
                
            }
            
        }

        $transaction->update();

        

        if ($this->verification == "verified") {
            $wallet = $transaction->wallet;
            if ($transaction->transaction_type->name == "Deposit") {
                $wallet->balance = $wallet->balance + $transaction->amount;
                $wallet->update();
            }elseif ($transaction->transaction_type->name == "Withdrawal") {
                    if ($wallet->balance > $transaction->amount) {
                        $wallet->balance = $wallet->balance - $transaction->amount;
                        if (isset($this->charge_amount)) {
                            $wallet->balance = $wallet->balance - $this->charge_amount;
                            $wallet->update();
                        }
                       
                    }   
            }

        $this->dispatch('hide-verificationModal');
        $this->resetInputFields();
        $this->dispatch('alert',[
            'type'=>'success',
            'message'=>"Transaction Verified Successfully!!"
        ]);
          
        }else {
            $this->dispatch('hide-verificationModal');
            $this->resetInputFields();
            $this->dispatch('alert',[
                'type'=>'success',
                'message'=>"Transaction Declined Successfully!!"
            ]);
        }

        
      
        
    }

    public function delete($id){
        $transaction = Transaction::find($id);
        $transaction->delete();
        $this->dispatch('alert',[
            'type'=>'success',
            'message'=>"Transaction Deleted Successfully!!"
        ]);
    }

    public function render()
    {
        $this->from_bank_accounts = BankAccount::where('company_id', Auth::user()->company->id)->orderBy('name','asc')->get();

        if (Auth::user()->is_admin || Auth::user()->company->type == "admin") {
            $this->transactions = Transaction::orderBy('created_at','desc')->get();

        }else {
            $this->transactions = Transaction::where('company_id', Auth::user()->company->id)->orderBy('created_at','desc')->get();

        }
        return view('livewire.transactions.index',[
            'from_bank_accounts' => $this->from_bank_accounts,
            'transactions' => $this->transactions
        ]);
    }
}
