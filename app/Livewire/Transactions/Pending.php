<?php

namespace App\Livewire\Transactions;

use App\Models\Wallet;
use App\Models\Company;
use Livewire\Component;
use App\Models\Transaction;
use Livewire\WithPagination;
use App\Mail\TransactionMail;
use App\Models\TransactionType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TransactionMailInternal;
use App\Mail\TransactionVerificationMail;

class Pending extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    private $transactions;
    public $transaction_id;
    public $authorization;
    public $authorized_by_id;
    public $reason;
    public $admin;
    public $selected_wallet;



    public function mount(){
        $this->admin = Company::where('type','admin')->first();
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

    private function resetInputFields(){

        $this->authorization = "";
        $this->reason = "";
        $this->selected_wallet = Null;
       
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
    protected $rules = [
        'authorization' => 'required',
        'reason' => 'required',
    ];



    public function showAuthorize($id){
        $this->transaction_id = $id;
        $this->transaction = Transaction::find($id);
        $this->dispatch('show-authorizationModal');
    }

    public function saveAuthorize(){

        $transaction = Transaction::find($this->transaction_id);
        $this->selected_wallet = $transaction->wallet;
        $receiving_wallet = Wallet::find($transaction->receiving_wallet_id);
        $transaction_type = TransactionType::find($transaction->transaction_type_id);
        
        
        if($transaction_type->name == "Deposit"){
            $transaction->authorized_by_id = Auth::user()->id;
            $transaction->authorization = $this->authorization;
            $transaction->reason = $this->reason;
            $transaction->update();

            if ($this->authorization == "approved") {
               
                $transaction->transaction_reference = $this->generateTransactionReference();
                $transaction->update();

                Mail::to("orders@freyt365.com")->send(new TransactionVerificationMail($transaction, $this->admin));

                 $this->dispatch('hide-authorizationModal');
                        $this->resetInputFields();
                        $this->dispatch(
                            'alert',
                            type : 'success',
                            title : "Deposit Transaction Approved Successfully!!",
                            position: "center",
                        );
    
            }else{
                $this->dispatch('hide-authorizationModal');
                $this->resetInputFields();
                $this->dispatch(
                    'alert',
                    type : 'success',
                    title : "Deposit Transaction Rejected Successfully!!",
                    position: "center",
                );
            }
        }else{    
                if (is_numeric($this->selected_wallet->balance) && $this->selected_wallet->balance > $transaction->amount) {
    
                    $transaction->authorized_by_id = Auth::user()->id;
                    $transaction->authorization = $this->authorization;
                    $transaction->reason = $this->reason;
                    $transaction->update();
    
                
                    if ($this->authorization == "approved") {

                                if ($transaction_type->name == "Internal Transfer") {
    
                                    $transaction_wallet_balance =   $this->selected_wallet->balance - $transaction->amount;
                                    $this->selected_wallet->balance =  $transaction_wallet_balance; 
                                    $this->selected_wallet->update();
    
                                    $transaction->transaction_reference = $this->generateTransactionReference();
                                    $transaction->wallet_balance = $transaction_wallet_balance;
                                    $transaction->verification = "verified";
                                    $transaction->status = 1;
                                    $transaction->update();

                                    if (isset($transaction->company->email)) {
                                        Mail::to($transaction->company->email)->send(new TransactionMail($transaction, $this->admin));
                                    } 
    
                                    if (isset($receiving_wallet)) {
                                        $receiving_wallet->balance = $receiving_wallet->balance + $transaction->amount;
                                        $receiving_wallet->update();

                                        if (isset($receiving_wallet->company->email)) {
                                            Mail::to($receiving_wallet->company->email)->send(new TransactionMailInternal($transaction,$receiving_wallet, $this->admin));
                                        } 
                                    }  
    
                                   
                                    
    
                                    $charge = $transaction_type->charge;
                                    if (isset($charge) && $charge->percentage > 0) {
    
                                        if ((isset($charge->percentage) && is_numeric($charge->percentage)) && (isset($transaction->amount) && is_numeric($transaction->amount))) {
                                            $charge_amount = ($charge->percentage/100) * $transaction->amount;
    
                                         
                                                $charge_transaction = new Transaction;
                                                $charge_transaction->transaction_number = $this->transactionNumber();
                                                $charge_transaction->user_id = 1;
                                                $charge_transaction->company_id = Auth::user()->company_id;
                                                $charge_transaction->transaction_reference = $this->generateTransactionReference();
                                                $charge_transaction->parent_transaction_id = $transaction->id;
                                                $charge_transaction->wallet_id = $transaction->wallet_id;
                                                $charge_transaction->movement = "Dbt";
                                                $charge_transaction->transaction_date = date('Y-m-d');
                                                $charge_transaction->transaction_type_id =  $transaction->transaction_type_id;
                                                $charge_transaction->charge_id = $charge->id;
                                                $charge_transaction->charge = $charge->percentage;
                                                $charge_transaction->charge_amount = $charge_amount;
                                                $charge_transaction->amount =  $charge_amount;
                                                $charge_transaction->currency_id = $transaction->currency_id;
                                                $charge_transaction->authorization = $transaction->authorization;
                                                $charge_transaction->verification = "verified";
                                                $charge_transaction->save();
    
                                                $charge_wallet_balance = $this->selected_wallet->balance - $charge_amount;
                                                $this->selected_wallet->balance =  $charge_wallet_balance;
                                                $this->selected_wallet->update();
                                            
                                                $charge_transaction->wallet_balance = $charge_wallet_balance;
                                                $charge_transaction->update();
                                          
                                           
                                        }
    
                                        if (isset($charge_transaction->company->email)) {
                                            Mail::to($charge_transaction->company->email)->send(new TransactionMail($charge_transaction, $this->admin));
                                        }   
                                    }

                                    $this->dispatch('hide-authorizationModal');
                                    $this->resetInputFields();
                                    $this->dispatch(
                                        'alert',
                                        type : 'success',
                                        title : "Internal Transfer Processed Successfully!!",
                                        position: "center",
                                    );
                

                                }elseif($transaction_type->name == "Withdrawal"){
                                  
                                    $transaction->transaction_reference = $this->generateTransactionReference();
                                    $transaction->update();

                                    Mail::to("orders@freyt365.com")->send(new TransactionVerificationMail($transaction, $this->admin)); 

                                    $this->dispatch('hide-authorizationModal');
                                    $this->resetInputFields();
                                    $this->dispatch(
                                        'alert',
                                        type : 'success',
                                        title : "Withdrawal Approved Successfully!!",
                                        position: "center",
                                    );
                                }
                        
                      
                    
                       
                
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
    
                
                }else{
                    $this->dispatch('hide-authorizationModal');
                    $this->resetInputFields();
                    $this->dispatch(
                        'alert',
                        type : 'error',
                        title : "You have insuffient funds to perform transaction!!",
                        position: "center",
                    );      
                }
    
            
        }
                
      
        
    }

  
    public function render()
    {

         return view('livewire.transactions.pending',[
            'transactions' => Transaction::where('company_id', Auth::user()->company->id)->where('authorization','pending')->orderBy('created_at','desc')->paginate(10)
        ]);
    }
}
