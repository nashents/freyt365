<?php

namespace App\Livewire\BankAccounts;

use App\Models\Country;
use Livewire\Component;
use App\Models\Currency;
use App\Events\ModalClosed;
use App\Models\BankAccount;
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportEvents\Event;

class Index extends Component
{
    public $name;
    public $currencies;
    public $currency_id;
    public $countries;
    public $country_id;
    public $company_id;
    public $type;
    public $account_name;
    public $account_number;
    public $branch;
    public $branch_code;
    public $swift_code;
    public $status;
    public $bank_account_id;

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
    
        $this->bank_accounts = BankAccount::where('company_id',Auth::user()->company_id)->orderBy('name')->get();
        $this->countries = Country::orderBy('name')->get();
        $this->currencies = Currency::orderBy('name')->get();

    }

    private function resetInputFields(){
        $this->branch = "" ;
        $this->country_id = "" ;
        $this->currency_id = "" ;
        $this->branch_code = "";
        $this->swift_code = "";
        $this->name = "";
        $this->account_number = "";
        $this->account_name = "";
        $this->status = "";
    }

    public function updated($value){
        $this->validateOnly($value);
    }
    protected $rules = [
        'currency_id' => 'required',
        'country_id' => 'required',
        'name' => 'required',
    ];

    public function store(){

        $this->validate();
        try{

            $bank_account = new BankAccount;
            $bank_account->user_id = Auth::user()->id;
            $bank_account->company_id =  Auth::user()->company->id;
            $bank_account->name = $this->name;
            $bank_account->currency_id = $this->currency_id;
            $bank_account->country_id = $this->country_id;
            $bank_account->account_number = $this->account_number;
            $bank_account->account_name = $this->account_name;
            $bank_account->branch = $this->branch;
            $bank_account->branch_code = $this->branch_code;
            $bank_account->swift_code = $this->swift_code;
            $bank_account->status = 1;
            $bank_account->save();
        

            // Event::dispatch(new ModalClosed());
            
            $this->dispatch('hide-bank_accountModal');
            
            $this->resetInputFields();

            $this->dispatch(
                'alert',
                type : 'success',
                title : "Bank Account Created Successfully!!",
                position: "center",
            );

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
        $this->country_id = $bank_account->country_id;
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
        $bank_account->country_id = $this->country_id;
        $bank_account->branch_code = $this->branch_code;
        $bank_account->swift_code = $this->swift_code;
        $bank_account->status = $this->status;
        $bank_account->update();
        $this->dispatch('hide-bank_accountEditModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Bank Account Updated Successfully!!",
            position: "center",
        );
    }
    public function render()
    {
        $this->bank_accounts = BankAccount::where('company_id',Auth::user()->company_id)->orderBy('name')->get();
        $this->currencies = Currency::orderBy('name')->get();
        return view('livewire.bank-accounts.index',[
            'bank_accounts' =>  $this->bank_accounts,
            'currencies' =>  $this->currencies,
        ]);
    }
}
