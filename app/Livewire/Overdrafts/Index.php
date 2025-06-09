<?php

namespace App\Livewire\overdrafts;

use App\Models\Wallet;
use App\Models\Company;
use Livewire\Component;
use App\Models\Overdraft;
use App\Models\TransactionType;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{

    public $overdrafts;
    public $overdraft;
    public $overdraft_id;
    public $is_active;
    public $limit;
    public $companies;
    public $selectedCompany;
    public $wallets;
    public $wallet_id;

    public function mount(){
        $this->overdrafts = Overdraft::all();
        $this->companies = Company::orderBy('name','asc')->get();
        $this->wallets = collect();
    }

    public function updatedSelectedCompany($id){
        if (!is_null($id)) {
            $this->wallets = Wallet::where('company_id',$id)->orderBy('name','asc')->get();
        }
    }

    private function resetInputFields(){ 
        $this->limit = "";
        $this->selectedCompany = "";
        $this->wallet_id = "";
    }

    public function store(){
        $overdraft = new Overdraft;
        $overdraft->user_id = Auth::user()->id;
        $overdraft->wallet_id = $this->wallet_id;
        $overdraft->company_id = $this->selectedCompany;
        $overdraft->limit = $this->limit;
        $overdraft->save();

        $this->dispatch('hide-overdraftModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Wallet Overdraft Created Successfully!!",
            position: "center",
        );
    }

    public function edit($id){
        $overdraft = Overdraft::find($id);
        $this->selectedCompany = $overdraft->company_id;
        $this->limit = $overdraft->limit;
        $this->is_active = $overdraft->is_active;
        $this->wallets = Wallet::where('company_id',$overdraft->company_id)->orderBy('name','asc')->get();
        $this->wallet_id = $overdraft->wallet_id;
        $this->overdraft_id = $overdraft->id;
        $this->dispatch('show-overdraftEditModal');
    }

    public function update(){
        $overdraft =  Overdraft::find($this->overdraft_id);
        $overdraft->wallet_id = $this->wallet_id;
        $overdraft->company_id = $this->selectedCompany;
        $overdraft->limit = $this->limit;
        $overdraft->is_active = $this->is_active;
        $overdraft->update();

        $this->dispatch('hide-overdraftEditModal');
        $this->resetInputFields();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Wallet Overdraft Updated Successfully!!",
            position: "center",
        );
    }

    public function delete($id){
        
        $overdraft = Overdraft::find($id);
        $overdraft->delete();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Wallet Overdraft Deleted Successfully!!",
            position: "center",
        );
    }

    public function render()
    {
        $this->overdrafts = Overdraft::all();
        return view('livewire.overdrafts.index',[
            'overdrafts' => $this->overdrafts
        ]);
    }
}
