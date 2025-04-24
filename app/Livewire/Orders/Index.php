<?php

namespace App\Livewire\Orders;

use App\Models\Order;
use App\Models\Driver;
use App\Models\Company;
use App\Models\Trailer;
use Livewire\Component;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\Transaction;
use App\Mail\TransactionMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Index extends Component
{

    public $wallets;
    public $selectedWallet;
    public $currency_id;
    public $transactions;
    public $transaction;
    public $transaction_id;
    public $transaction_date;
    public $transaction_number;
    public $reference_code;
    public $verification;
    public $verified_by_id;
    public $authorization;
    public $authorized_by_id;
    public $reason;
    public $verification_reason;
    public $amount;
    public $charge;
    public $transaction_types;
    public $selectedTransactionType;
    public $transaction_type;
    public $selected_transaction_type;
    public $selected_wallet;
    public $admin;
    public $wallet_balance;

    public $orders;
    public $order;
    public $order_id;


    public function mount(){

        $this->admin = Company::where('type','admin')->first();
      
    }

       
    private function resetInputFields(){
        $this->reference_code = "" ;
        $this->selectedWallet = "" ;
        $this->transaction_date = "";
        $this->amount = "";
        $this->selectedTransactionType = "";
        $this->authorization = "";
        $this->verification = "";
        $this->reason = "";
        $this->verification_reason = "";
        $this->selected_wallet = Null;
        $this->wallet_balance = Null;
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


    public function showVerify($id){
        $this->order_id = $id;
        $this->order = Order::find($id);
        $this->transaction = $this->order->transaction;
        $this->dispatch('show-verificationModal');
    }

    public function saveVerify(){

        $transaction = Transaction::find($this->transaction->id);
        $transaction->verified_by_id = Auth::user()->id;
        $transaction->verification = $this->verification;
        $transaction->verification_reason = $this->reason;
        $transaction->update();

        $wallet = $transaction->wallet;
  
        if ($this->verification == "verified") {
           

            if (is_numeric($wallet->balance) && is_numeric($transaction->amount) ) {
                $transaction_wallet_balance = $wallet->balance - $transaction->amount;
                $wallet->balance =  $transaction_wallet_balance;
                $wallet->update();

                $transaction->status = 1;
                $transaction->wallet_balance = $transaction_wallet_balance;
                $transaction->update();

                $order = Order::find($this->order_id);
                $order->status = "successful";
                $order->update();

                if (isset($transaction->company->email)) {
                    Mail::to($transaction->company->email)->send(new TransactionMail($transaction, $this->admin));
                }
            }  

        $this->dispatch('hide-verificationModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Transaction Verified & Processed Successfully!!",
            position: "center",
        );
          
        }else {

            $order = Order::find($this->order_id);
            $order->status = "unsuccessful";
            $order->update();

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
        $order = Order::find($id);
        $transaction = $order->transaction;
      
        if (isset($transaction)) {
            $transaction->delete();
        }
       
        $order->delete();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Order Deleted Successfully!!",
            position: "center",
        );
    }




    public function render()
    {
        if (Auth::user()->is_admin || Auth::user()->company->is_admin()) {
            $this->orders = Order::where('authorization','approved')->orderBy('created_at','desc')->get();

        }else {
            $this->orders = Order::where('company_id', Auth::user()->company->id)->orderBy('created_at','desc')->get();

        }
        return view('livewire.orders.index',[
            'orders' => $this->orders
        ]);
    }
}
