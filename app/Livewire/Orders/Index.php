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
use Livewire\WithPagination;
use App\Mail\TransactionMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Index extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    
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

    private $orders;
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

    public function verifyOrder(){

        $transaction = Transaction::find($this->transaction_id);
        $transaction->verified_by_id = Auth::user()->id;
        $transaction->verification = $this->verification;
        $transaction->verification_reason = $this->reason;
        $transaction->update();

        $wallet = $transaction->wallet;
  
        if ($this->verification == "verified") {
    
                $transaction_wallet_balance = $wallet->balance - $transaction->amount;
                $wallet->balance =  $transaction_wallet_balance;
                $wallet->update();

                $transaction->status = 1;
                $transaction->wallet_balance = $transaction_wallet_balance;
                $transaction->update();

                $order = Order::find($this->order_id);
                $order->status = "successful";
                $order->update();

                if ($transaction->company->email) {
                    Mail::to($transaction->company->email)->send(new TransactionMail($transaction, $this->admin));
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

    public function showVerify($id){
        $this->order_id = $id;
        $this->order = Order::find($id);
        $this->transaction_id = $this->order->transaction->id;
        $this->dispatch('show-verificationModal');
    }

    public function saveVerify(){

        $transaction = $this->order->transaction;
        $wallet = $this->order->wallet;

        if (!$wallet && ! $transaction) {
         
            $this->dispatch('hide-authorizationModal');
            $this->resetInputFields();
            $this->dispatch(
                'alert',
                type : 'error',
                title : "Something wrong with the order, delete and create a new one!!",
                position: "center",
            );

            return ;
        }

        $total = floatval($transaction->amount); // ensure it's numeric

        if ($wallet->overdraft && $wallet->overdraft->is_active) {
            $overdraftLimit = $wallet->overdraft->limit;
            $availableLimit = $wallet->balance - $total;

            if ($availableLimit < -$overdraftLimit) {
                $this->dispatch(
                    'alert',
                    type: 'error',
                    title: "Insufficient funds, overdraft limit exceeded!!",
                    position: "center",
                );
                return;
            }

             $this->verifyOrder(); // Order is allowed within overdraft
            return;
        }

      if (is_numeric($wallet->balance) && is_numeric($total) && $wallet->balance >= $total) {
            $this->verifyOrder();
       }else{
            $this->dispatch('hide-verificationModal');
            $this->resetInputFields();
            $this->dispatch(
                'alert',
                type : 'error',
                title : "The client has insuffient funds to verify this order!!",
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
            return view('livewire.orders.index',[
                'orders' => Order::where('authorization','approved')->orderBy('created_at','desc')->paginate(10)
            ]);
        
        }else {
            return view('livewire.orders.index',[
                'orders' => Order::where('company_id', Auth::user()->company->id)->orderBy('created_at','desc')->paginate(10)
            ]);
        }
       
    }
}
