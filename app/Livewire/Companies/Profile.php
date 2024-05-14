<?php

namespace App\Livewire\Companies;

use App\Models\Company;
use Livewire\Component;
use App\Models\Currency;

class Profile extends Component
{

    public $name;
    public $email;
    public $noreply;
    public $role_id;
    public $roles;
    public $phonenumber;
    public $country;
    public $city;
    public $suburb;
    public $street_address;
    public $currencies;
    public $currency_id;
    public $companies;
    public $company;
    public $vat_number;
    public $tin_number;
    public $company_id;
    public $user_id;
    public $invoice_memo;
    public $invoice_footer;
    public $fiscalize;
    public $color;
    public $vat;

    public function mount($company){
        $this->company = $company;
        $this->company_id = $company->id;
        $this->name = $company->name;
        $this->email = $company->email;
        $this->noreply = $company->noreply;
        $this->phonenumber = $company->phonenumber;
        $this->country = $company->country;
        $this->tin_number = $company->tin_number;
        $this->vat_number = $company->vat_number;
        $this->city = $company->city;
        $this->suburb = $company->suburb;
        $this->street_address = $company->street_address;
        $this->color = $company->color;
        $this->fiscalize = $company->fiscalize;
        $this->vat = $company->vat;
        $this->currencies = Currency::orderBy('name','asc')->get();
        $this->currency_id = $company->currency_id;
        $this->invoice_memo = $company->invoice_memo;
        $this->invoice_footer = $company->invoice_footer;
      
    }
    public function update(){
        $company = Company::find($this->company_id);
        $company->name = $this->name;
        $company->email = $this->email;
        $company->phonenumber = $this->phonenumber;
        $company->currency_id = $this->currency_id;
        $company->fiscalize = $this->fiscalize;
        $company->vat_number = $this->vat_number;
        $company->tin_number = $this->tin_number;
        $company->country = $this->country;
        $company->city = $this->city;
        $company->suburb = $this->suburb;
        $company->street_address = $this->street_address;
        $company->vat = $this->vat;
        $company->color = $this->color;
        $company->invoice_memo = $this->invoice_memo;
        $company->invoice_footer = $this->invoice_footer;
        $company->update();

        $this->dispatch('alert',[
            'type'=>'success',
            'message'=>"Company Settings Updated Successfully!!"
        ]);
        return redirect(request()->header('Referer'));
    }

    public function useOffloadingDetails(){
        if ($this->offloading_details == TRUE) {
           
        }
    }
    public function render()
    {
        return view('livewire.companies.profile');
    }
}
