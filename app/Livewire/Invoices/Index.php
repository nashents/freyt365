<?php

namespace App\Livewire\Invoices;

use App\Models\Trip;
use App\Models\Invoice;
use Livewire\Component;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\BankAccount;
use App\Models\InvoiceItem;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{

    public $search;
    protected $queryString = ['search'];
    public $from;
    public $to;
    public $reason;
    public $invoice_products;
    public $invoice_product_id;
    public $description;
    public $qty = 1;
    public $amount = 0;
    public $invoices;
    public $invoice_number;
    public $number;
    public $invoice_id;
    public $initials;
    public $customers;
    public $trips;
    public $exchange_rate;
    public $exchange_amount;
    public $trip;
    public $invoice_trip;
    public $trip_id;
    public $selectedCustomer;
    public $bank_accounts;
    public $bank_account_id;
    public $company_id;
    public $currencies;
    public $destinations;
    public $selectedCurrency;
    public $selectedTrip = [];
    public $trip_sum = [];
    public $vat;
    public $vat_amount;
    public $invoice_sub_amount = 0;
    public $turnover = 0;
    public $invoice_total_amount = 0;
    public $date;
    public $expiry;
    public $subheading;
    public $memo;
    public $footer;
    public $product_name;
    public $product_description;
    public $item_subtotal = 0;
    public $subtotal = 0;
    public $total = 0;
    public $user_id;

  

    public function mount(){
        
        $this->invoice_number = $this->invoiceNumber();
        $this->qty = 1;

        $this->invoices = Invoice::orderBy('invoice_number','asc')->get();
        $this->customers = Customer::orderBy('name','asc')->get();
        $this->currencies = Currency::orderBy('name','asc')->get();
        $this->bank_accounts = BankAccount::orderBy('name','asc')->get();
        $this->trips = Trip::where('company_id',Auth::user()->company->id)->orderBy('created_at','desc')->get();
        $this->memo = Auth::user()->company->invoice_memo;
        $this->footer = Auth::user()->company->invoice_footer;
        $this->vat = Auth::user()->company->vat;
        $this->company_id = Auth::user()->company->id;
    }

    private function resetInputFields(){
        $this->bank_account_id = [];
        $this->selectedCustomer = "";
        $this->selectedCurrency = "";
        $this->amount = "";
        $this->invoice_number = "";
        $this->date = "";
        $this->expiry = "";
        $this->vat = "";
        $this->memo = "";
        $this->footer = "";
      
    }

    public function invoiceNumber(){
      
   
        $str = Auth::user()->company->name;
        $words = explode(' ', $str);
        if (isset($words[1][0])) {
            $this->initials = $words[0][0].$words[1][0];
        }else {
            $this->initials = $words[0][0];
        }
        $invoice = Invoice::where('company_id',Auth::user()->company->id)->orderBy('id','desc')->get()->first();
        if (!$invoice) {
            $this->number = 1;
            $invoice_number =  $this->initials .'I'. str_pad(1, 5, "0", STR_PAD_LEFT);
        }else {
            $this->number = $invoice->id + 1;
            $invoice_number =  $this->initials .'I'. str_pad($this->number, 5, "0", STR_PAD_LEFT);
        }
    
        return  $invoice_number;
    
    
    }

    public function updatedSelectedtrip($id){
    
        if (!is_null($id)) {
            $trip = Trip::find($id);
            if (isset($trip)) {
                $this->selectedCurrency = $trip->currency->id;
                $this->amount = $trip->freight;
            }
            
        }
    }

    public function updated($value){
        $this->validateOnly($value);
    }
    protected $rules = [
        'selectedTrip' => 'required',
        'selectedCustomer' => 'required',
        'amount' => 'required',
        'selectedCurrency' => 'required',
        'date' => 'required',
    ];


    public function updatedSelectedCurrency($id){
        $currency = Currency::find($id);
        $this->bank_accounts = BankAccount::where('currency_id',$id)->orderBy('name','asc')->get();
    }

    public function store(){
      
        $invoice =  new Invoice;
        $invoice->user_id = Auth::user()->id;
        $invoice->company_id = Auth::user()->company_id;
        $invoice->invoice_number = $this->invoiceNumber();
        $invoice->customer_id = $this->selectedCustomer;
        $invoice->currency_id = $this->selectedCurrency;
        $invoice->bank_account_id = $this->bank_account_id;
        $invoice->vat = $this->vat;
        $invoice->date = $this->date;
        $invoice->expiry = $this->expiry;
        $invoice->memo = $this->memo;
        $invoice->footer = $this->footer;
        $invoice->save();

        if (isset($this->selectedTrip) && $this->selectedTrip != "") {
            foreach ($this->selectedTrip as $key => $value) {
                $trip = Trip::find($this->selectedTrip[$key]);
              
                $cargo = $trip->cargo;
                if ($trip->horse) {
                    $regnumber = $trip->horse ? $trip->horse->registration_number : "";
                }
                $horse = $regnumber;
                $symbol =  $trip->currency ? $trip->currency->symbol : "";             
               
                $from = $trip->from;
                $to = $trip->to;
                $weight = $trip->weight ? $trip->weight." Tons" : "";
                $rate = $trip->rate;
                $litreage = $trip->litreage ? "| ".$trip->litreage." Litres" : "";
                $trip_details =  $weight." ".$litreage." ".$cargo;
    
                $invoice_item = new InvoiceItem;
                $invoice_item->invoice_id = $invoice->id;

                if (isset($this->selectedTrip[$key])) {
                    $invoice_item->trip_id = $this->selectedTrip[$key];
                }
            
                $invoice_item->trip_details = $trip_details .' '.  $from .' to '.  $to .' '.  $horse;
                $invoice_item->qty = $this->qty;
                $invoice_item->amount = $trip->freight;
                if (isset($trip->freight) && isset($this->qty)) {
                    $invoice_item->subtotal = $trip->freight*$this->qty;
                }
               
                $invoice_item->save();
            }
        }

        if ($this->vat != "") {
            $this->subtotal = $this->amount;
            $this->vat_amount = ($this->subtotal * ($this->vat / 100 ));
            $this->total = ($this->subtotal +  $this->vat_amount);
        }else {
            $this->subtotal = $this->amount;
            $this->vat_amount = 0;
            $this->total = $this->subtotal;
        }
        $invoice = Invoice::find($invoice->id);
        $invoice->vat =  $this->vat;
        $invoice->vat_amount =  $this->vat_amount;
        $invoice->subtotal = $this->subtotal;
        $invoice->total = $this->total;
        $invoice->balance = $this->total;
        $invoice->update();
       
      
        $this->dispatch('hide-invoiceModal');
        $this->resetInputFields();
        $this->dispatch('alert',[
            'type'=>'success',
            'message'=>"Invoice Created Successfully!!"
        ]);

    }

    public function delete($id){
        $invoice = Invoice::find($id);
        $invoice_items = $invoice->invoice_items;
        if (isset($invoice_items)) {
            foreach ($invoice_items as $invoice_item) {
                $invoice_item->delete();
            }
        }
        $invoice->delete();
        $this->dispatch('alert',[
            'type'=>'success',
            'message'=>"Invoice Deleted Successfully!!"
        ]);
    }

    public function render()
    {
        $this->invoices = Invoice::where('company_id', Auth::user()->id)->orderBy('invoice_number','asc')->get();
        return view('livewire.invoices.index',[
            'invoices' => $this->invoices
        ]);
    }
}
