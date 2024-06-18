<?php

namespace App\Livewire\Companies;

use App\Models\Company;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{

    public $companies;
    public $company_id;
    public $company;
    public $authorization;
    public $authorized_by_id;
    public $reason;

    public function mount(){
        $this->companies = Company::orderBy('name','asc')->get();
    }

    private function resetInputFields(){
      
        $this->authorization = "";
        $this->reason = "";
    }
   

    public function showAuthorize($id){
        $this->company_id = $id;
        $this->company = Company::find($id);
        $this->dispatch('show-authorizationModal');
    }

    public function saveAuthorization(){

        $company = Company::find($this->company_id);
        $company->authorized_by_id = Auth::user()->id;
        $company->authorization = $this->authorization;
        $company->reason = $this->reason;
        $company->status = $this->authorization == "approved" ? 1 : 0;
        $company->update();

        if ($this->authorization == "approved") {
            $this->dispatch('hide-authorizationModal');
            $this->resetInputFields();
            $this->dispatch(
                'alert',
                type : 'success',
                title : "Company Approved Successfully!!",
                position: "center",
            );
        }else {
            $this->dispatch('hide-authorizationModal');
            $this->resetInputFields();
            $this->dispatch(
                'alert',
                type : 'success',
                title : "Company Rejected Successfully!!",
                position: "center",
            );
        }

      
      
        
    }

    public function delete($id){
        $company = Company::find($id);
        $company->delete();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Company Deleted Successfully!!",
            position: "center",
        );
    }
   

    public function render()
    {
        return view('livewire.companies.index');
    }
}
