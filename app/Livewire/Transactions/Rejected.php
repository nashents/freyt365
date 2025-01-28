<?php

namespace App\Livewire\Transactions;

use App\Models\Company;
use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TransactionVerificationMail;

class Rejected extends Component
{
    public $transactions;
    public $admin;
    public $transaction;
    public $transaction_id;
    public $authorization;
    public $authorized_by_id;
    public $reason;



    public function mount(){


        $this->admin = Company::where('type','admin')->first();
        $this->transactions = Transaction::where('company_id', Auth::user()->company->id)->where('authorization','rejected')->orderBy('created_at','desc')->get();

    }

   

    private function resetInputFields(){

        $this->authorization = "";
        $this->reason = "";
       
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
        $transaction->authorized_by_id = Auth::user()->id;
        $transaction->authorization = $this->authorization;
        $transaction->reason = $this->reason;
        $transaction->update();

        if ($this->authorization == "rejected") {
            $this->dispatch('hide-authorizationModal');
            $this->resetInputFields();
            $this->dispatch(
                'alert',
                type : 'success',
                title : "Transaction Rejected Successfully!!",
                position: "center",
            );
        }else {

            if (isset($this->admin->email)) {
                Mail::to($this->admin->email)->send(new TransactionVerificationMail($transaction, $this->admin));
            }
            
            $this->dispatch('hide-authorizationModal');
            $this->resetInputFields();
            $this->dispatch(
                'alert',
                type : 'success',
                title : "Transaction Approved Successfully!!",
                position: "center",
            );
        }

      
      
        
    }

  
    public function render()
    {

        $this->transactions = Transaction::where('company_id', Auth::user()->company->id)->where('authorization','rejected')->orderBy('created_at','desc')->get();
        return view('livewire.transactions.rejected',[
            'transactions' => $this->transactions
        ]);
    }
}
