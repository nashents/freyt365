<?php

namespace App\Livewire\Transactions;

use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class Approved extends Component
{

    public $transactions;
    public $transaction;
    public $transaction_id;
    public $authorization;
    public $authorized_by_id;
    public $reason;



    public function mount(){

        if (Auth::user()->is_admin || Auth::user()->company->type == "admin") {
            $this->transactions = Transaction::where('authorization','approved')->orderBy('created_at','desc')->get();

        }else {
            $this->transactions = Transaction::where('company_id', Auth::user()->company->id)->where('authorization','approved')->orderBy('created_at','desc')->get();

        }

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

        if ($this->authorization == "approved") {
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

  
    public function render()
    {

        if (Auth::user()->is_admin || Auth::user()->company->type == "admin") {
            $this->transactions = Transaction::where('authorization','approved')->orderBy('created_at','desc')->get();

        }else {
            $this->transactions = Transaction::where('company_id', Auth::user()->company->id)->where('authorization','approved')->orderBy('created_at','desc')->get();

        }
        return view('livewire.transactions.approved',[
            'transactions' => $this->transactions
        ]);
    }
}
