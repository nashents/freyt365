<?php

namespace App\Livewire\BankAccounts;

use Livewire\Component;
use App\Models\Currency;
use App\Models\BankAccount;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $name;
    public $currencies;
    public $currency_id;
    public $company_id;
    public $type;
    public $account_name;
    public $account_number;
    public $branch;
    public $branch_code;
    public $swift_code;
    public $status;

    public $inputs = [];
    public $i = 1;
    public $n = 1;

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs ,$i);
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }
    public function mount(){
        if (isset(Auth::user()->company)) {
            $this->company_id = Auth::user()->company->id;
          } else {
            $this->company_id = Auth::user()->employee->company->id;
          }
        $this->bank_accounts = BankAccount::latest()->get();
        $this->currencies = Currency::latest()->get();

    }

    private function resetInputFields(){
        $this->branch = "" ;
        $this->currency_id = "" ;
        $this->branch_code = "";
        $this->swift_code = "";
        $this->name = "";
        $this->account_number = "";
        $this->account_name = "";
        $this->status = "";
    }

    public function store(){
        try{

                    $bank_account = new BankAccount;
                    $bank_account->user_id = Auth::user()->id;
                    $bank_account->company_id = $this->company_id;
                    $bank_account->name = $this->name;
                    $bank_account->currency_id = $this->currency_id;
                    $bank_account->account_number = $this->account_number;
                    $bank_account->account_name = $this->account_name;
                    $bank_account->branch = $this->branch;
                    $bank_account->branch_code = $this->branch_code;
                    $bank_account->swift_code = $this->swift_code;
                    $bank_account->status = 1;
                    $bank_account->save();
        

            $this->dispatch('hide-bank_accountModal');
            $this->resetInputFields();
            $this->dispatch('alert',[
                'type'=>'success',
                'message'=>"Bank Account Uploaded Successfully!!"
            ]);
        }catch(\Exception $e){
            // Set Flash Message
            $this->dispatch('alert',[
                'type'=>'error',
                'message'=>"Something went wrong while creating bank account(s)!!"
            ]);
        }
    }

    public function edit($id){
        $bank_account = BankAccount::find($id);
        $this->name = $bank_account->name;
        $this->type = $bank_account->type;
        $this->account_number = $bank_account->account_number;
        $this->account_name = $bank_account->account_name;
        $this->branch = $bank_account->branch;
        $this->branch_code = $bank_account->branch_code;
        $this->currency_id = $bank_account->currency_id;
        $this->swift_code = $bank_account->swift_code;
        $this->status = $bank_account->status;
        $this->bank_account_id = $bank_account->id;
        $this->dispatch('show-bank_accountEditModal');
    }
    public function update(){
        $bank_account = BankAccount::find($this->bank_account_id);
        $bank_account->user_id = Auth::user()->id;
        $bank_account->name = $this->name;
        $bank_account->type = $this->type;
        $bank_account->account_number = $this->account_number;
        $bank_account->account_name = $this->account_name;
        $bank_account->branch = $this->branch;
        $bank_account->currency_id = $this->currency_id;
        $bank_account->branch_code = $this->branch_code;
        $bank_account->swift_code = $this->swift_code;
        $bank_account->status = $this->status;
        $bank_account->update();
        $this->dispatch('hide-bank_accountEditModal');
        $this->resetInputFields();
        $this->dispatch('alert',[
            'type'=>'success',
            'message'=>"Bank Account Updated Successfully!!"
        ]);
    }
    public function render()
    {
        $this->bank_accounts = BankAccount::latest()->get();
        return view('livewire.bank-accounts.index',[
            'bank_accounts' =>  $this->bank_accounts
        ]);
    }
}
