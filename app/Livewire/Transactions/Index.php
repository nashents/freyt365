<?php

namespace App\Livewire\Transactions;

use App\Models\Wallet;
use App\Models\Company;
use Livewire\Component;
use App\Models\Currency;
use App\Models\BankAccount;
use App\Models\Transaction;
use App\Mail\TransactionMail;
use App\Models\TransactionType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Index extends Component
{

    public $wallets;
    public $selectedWallet;
    public $receiving_wallet_number;
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
    public $selectedMop;
    public $amount;
    public $charge;
    public $transaction_types;
    public $selectedTransactionType;
    public $transaction_type;
    public $selected_transaction_type;
    public $selected_wallet;
    public $admin;

    protected $listeners = ['echo:transactions,' . \App\Events\TransactionCreated::class => 'refreshTransactions'];

    public function refreshTransactions($payload)
    {
        // Handle the incoming payload if needed
        // For example, you can log the payload or perform other actions
        // \Log::info('Transaction Created:', $payload);

        // Refresh the component to fetch the latest transactions
        $this->emitSelf('refresh');
    }


    public function mount(){
        $this->admin = Company::where('type','admin')->first();
        $this->wallets = Wallet::where('company_id', Auth::user()->id)->orderBy('name','asc')->get();
        $this->currencies = Currency::orderBy('name','asc')->get();
        $this->transaction_types = TransactionType::orderBy('name','asc')->get();
        
        if (Auth::user()->is_admin || Auth::user()->company->is_admin()) {
            $this->transactions = Transaction::where('authorization','approved')->orderBy('created_at','desc')->get();

        }else {
            $this->transactions = Transaction::where('company_id', Auth::user()->company->id)->orderBy('created_at','desc')->get();

        }

        

       
       
    }

   
    private function resetInputFields(){
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

    public function generateTransactionNumber($digits = 6){
        $i = 0; //counter
        $number = ""; //our default pin is blank.
        while($i < $digits){
            //generate a random number between 0 and 9.
            $number .= mt_rand(0, 6);
            $i++;
        }
        return $number;
    }

    function generateTransactionReference($length = 6) {
        // Characters to use in the code
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomCode = '';
    
        // Generate the random code
        for ($i = 0; $i < $length; $i++) {
            $randomCode .= $characters[rand(0, $charactersLength - 1)];
        }
    
        return $randomCode;
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

    public function updated($value){
        $this->validateOnly($value);
    }

    protected $messages = [
        'receiving_wallet_number.exists:wallets,wallet_number' => 'The receiving wallet could not be found.'
    ];

    protected $rules = [
        'amount' => 'required',
        'selectedWallet' => 'required',
        'receiving_wallet_number' => 'nullable|exists:wallets,wallet_number',
        'selectedMop' => 'required',
        'transaction_date' => 'required',
        'selectedTo' => 'required',
    ];

    public function updatedSelectedTransactionType($id){
        if (!is_null($id)) {
            $this->selected_transaction_type = TransactionType::find($id);
        }
    }



    public function updatedSelectedWallet($id){
        if (!is_null($id)) {
            $wallet = Wallet::find($id);
            $this->currency_id = $wallet->currency_id;

            $this->admin = Company::where('type','admin')->first();

            if (isset($this->admin)) {
                $this->to_bank_accounts = BankAccount::where('company_id',  $this->admin->id)->where('currency_id',$this->currency_id)->orderBy('name','asc')->get();
                $this->from_bank_accounts = BankAccount::where('company_id', Auth::user()->company->id)->where('currency_id',$this->currency_id)->orderBy('name','asc')->get();
            }
        }
    }

    public function sendMoney(){
        $transaction = new Transaction;
        $transaction->transaction_number = $this->transactionNumber();
        $transaction->user_id = Auth::user()->id;
        $transaction->company_id = Auth::user()->company_id;
        $transaction->wallet_id = $this->selectedWallet;
        $transaction->receiving_wallet_id = $this->selected_wallet->id;
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
    }


    public function store(){

        if (isset($this->selected_transaction_type) && $this->selected_transaction_type->name == "Internal Transfer") {
       
            if (isset($this->currency_id) && isset($this->receiving_wallet_number)) {
                $this->selected_wallet = Wallet::where('currency_id',$this->currency_id)->where('wallet_number',$this->receiving_wallet_number)->first();
                if (isset($this->selected_wallet)) {
                    $this->dispatch('show-transaction_confirmationModal');
                }
            }
         
           
           
        }else{
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
        }
       
        
   

   
      
    }


    public function edit($id){
        $transaction = Transaction::find($id);
        $this->selectedMop = $transaction->mop;
        $this->reference_code = $transaction->reference_code;
        $this->selectedTransactionType = $transaction->transaction_type_id;
        $this->selectedFrom = $transaction->from;
        $this->selectedTo = $transaction->to;
        $this->amount = $transaction->amount;
        $this->currency_id = $transaction->currency_id;
        $this->transaction_date = $transaction->transaction_date;
        $this->transaction_id = $id;
        $this->dispatch('show-transactionEditModal');

    }

    public function update(){
        $transaction =  Transaction::find($this->transaction_id);
        $transaction->transaction_date = $this->transaction_date;
        $transaction->reference_code = $this->reference_code;
        $transaction->transaction_type_id =  $this->selectedTransactionType;
        $transaction->mop = $this->selectedMop;
        $transaction->from = $this->selectedFrom;
        $transaction->to = $this->selectedTo;
        $transaction->amount = $this->amount;
        $transaction->currency_id = $this->currency_id;
        $transaction->update();

        $this->dispatch('hide-transactionEditModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Transaction Updated Successfully!!",
            position: "center",
        );

   
      
    }

    public function showAuthorize($id){
        $this->transaction_id = $id;
        $this->transaction = Transaction::find($id);
        $this->dispatch('show-authorizationModal');
    }

    public function calculateCharges(){

    }

    public function saveAuthorize(){

        $transaction = Transaction::find($this->transaction_id);
        $transaction->authorized_by_id = Auth::user()->id;
        $transaction->authorization = $this->authorization;
        $transaction->reason = $this->reason;
        $transaction->update();

        if ($this->authorization == "approved") {


        $transaction_type = TransactionType::find($transaction->transaction_type_id);
            if (isset($transaction_type)) {
               
             if ($transaction->transaction_type->name == "Internal Transfer") {

                $charge = $transaction_type->charge;
                if (isset($charge)) {
                    if ((isset($charge->percentage) && is_numeric($charge->percentage)) && (isset($transaction->amount) && is_numeric($transaction->amount))) {
                        $charge_amount = ($charge->percentage/100) * $transaction->amount;
                        $transaction->charge = $charge->percentage;
                        $transaction->charge_amount = $charge_amount;
                    }
                }

                $transaction->transaction_date = date('Y-m-d');
                $transaction->transaction_reference = $this->generateTransactionReference();
                $transaction->status = 1;
                $transaction->movement = "Dbt";
                $transaction->update();

                $sending_wallet = $transaction->wallet;
                $receiving_wallet = Wallet::find($transaction->receiving_wallet_id);

                        if (is_numeric($sending_wallet->balance) && is_numeric($transaction->amount) && $sending_wallet->balance > $transaction->amount) {
                            $sending_wallet->balance = $sending_wallet->balance - $transaction->amount;
                            if (isset($charge_amount)) {
                                $sending_wallet->balance = $sending_wallet->balance - $charge_amount;
                                $sending_wallet->update();
                            }    
                            if (isset($receiving_wallet)) {
                                $receiving_wallet->balance = $receiving_wallet->balance + $transaction->amount;
                                $receiving_wallet->update();
                            }     
                        }   

                        if (isset($transaction->company->email)) {
                            Mail::to($transaction->company->email)->send(new TransactionMail($transaction, $this->admin));
                        }


                }
              
            }
           

           

            $this->dispatch('hide-authorizationModal');
            $this->resetInputFields();
            $this->dispatch(
                'alert',
                type : 'success',
                title : "Transaction Approved Successfully!!",
                position: "center",
            );
        }else {
            $this->dispatch('hide-authorizationModal');
            $this->resetInputFields();
            $this->dispatch(
                'alert',
                type : 'success',
                title : "Transaction Rejected Successfully!!",
                position: "center",
            );
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
        $transaction->update();
  
        if ($this->verification == "verified") {
            $wallet = $transaction->wallet;
            if ($transaction->transaction_type->name == "Deposit") {

                $transaction_type = TransactionType::find($transaction->transaction_type_id);
                if (isset($transaction_type)) {
                    $charge = $transaction_type->charge;
                    if (isset($charge)) {
                        if (isset($charge->percentage) && isset($transaction->amount)) {
                            $charge_amount = ($charge->percentage/100) * $transaction->amount;
                            $transaction->charge = $charge->percentage;
                            $transaction->charge_amount = $charge_amount;
                        }
                        
                    }
                    
                }
                $transaction->movement = "Crt";
                $transaction->transaction_reference = $this->generateTransactionReference();
                $transaction->status = 1;
                $transaction->update();
                if (is_numeric($wallet->balance) && is_numeric($transaction->amount)) {
                    $wallet->balance = $wallet->balance + $transaction->amount;
                    $wallet->update();
                }
            }elseif ($transaction->transaction_type->name == "Withdrawal") {
                $transaction_type = TransactionType::find($transaction->transaction_type_id);
                if (isset($transaction_type)) {
                    $charge = $transaction_type->charge;
                    if (isset($charge)) {
                        if (isset($charge->percentage) && isset($transaction->amount)) {
                            $charge_amount = ($charge->percentage/100) * $transaction->amount;
                            $transaction->charge = $charge->percentage;
                            $transaction->charge_amount = $charge_amount;
                        }
                        
                    }
                    
                }
                $transaction->movement = "Dbt";
                $transaction->transaction_reference = $this->generateTransactionReference();
                $transaction->status = 1;
                $transaction->update();
                    if (is_numeric($wallet->balance) && is_numeric($transaction->amount) && $wallet->balance > $transaction->amount) {
                        $wallet->balance = $wallet->balance - $transaction->amount;
                        if (isset($charge_amount)) {
                            $wallet->balance = $wallet->balance - $charge_amount;
                            $wallet->update();
                        }          
                    }   
            }

        if (isset($transaction->company->email)) {
            Mail::to($transaction->company->email)->send(new TransactionMail($transaction, $this->admin));
        }

        $this->dispatch('hide-verificationModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Transaction Verified Successfully!!",
            position: "center",
        );
          
        }else {
            $this->dispatch('hide-verificationModal');
            $this->resetInputFields();
            $this->dispatch(
                'alert',
                type : 'success',
                title : "Transaction Declined Successfully!!",
                position: "center",
            );
        }

        
      
        
    }

    public function delete($id){
        $transaction = Transaction::find($id);
        $transaction->delete();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Transaction Deleted Successfully!!",
            position: "center",
        );
    }

    public function render()
    {
        $this->from_bank_accounts = BankAccount::where('company_id', Auth::user()->company->id)->orderBy('name','asc')->get();

        if (Auth::user()->is_admin || Auth::user()->company->type == "admin") {
            $this->transactions = Transaction::where('authorization','approved')->orderBy('created_at','desc')->get();

        }else {
            $this->transactions = Transaction::where('company_id', Auth::user()->company->id)->orderBy('created_at','desc')->get();

        }
        return view('livewire.transactions.index',[
            'from_bank_accounts' => $this->from_bank_accounts,
            'transactions' => $this->transactions
        ]);
    }
}
