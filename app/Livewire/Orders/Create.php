<?php

namespace App\Livewire\Orders;

use App\Models\Horse;
use App\Models\Order;
use App\Models\Driver;
use App\Models\Wallet;
use App\Models\Country;
use App\Models\Service;
use App\Models\Trailer;
use Livewire\Component;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{

    public $wallets;
    public $wallet;
    public $selected_wallet;
    public $selectedWallet;
    public $currency_id;
    public $selected_currency;
    public $horses;
    public $horse;
    public $selected_horse;
    public $selectedHorse;
    public $drivers;
    public $driver;
    public $selected_driver;
    public $selectedDriver;
    public $countries;
    public $service_providers;
    public $service_provider_id;
    public $services;
    public $service_id = [];
    public $selectedCountry;
    public $country;
    public $selected_country;
    public $trailers;
    public $trailer_id;
    public $collection_date;
    public $transaction_type;
    public $charge_amount;
    public $charge;
    public $total = 0;
    public $amount;
    public $uniqueid;
    public $order_item;
    public $opened_service_ids = [];
    public $next = False;

    public $branch_id = [];
    public $fuel_station_id = [];
    public $office_id = [];

    public function mount(){
        $this->customers = Customer::where('company_id',Auth::user()->company_id)->orderBy('name','asc')->get();
        $this->drivers = Driver::where('company_id',Auth::user()->company_id)->orderBy('name','asc')->get();
        $this->horses = Horse::where('company_id',Auth::user()->company_id)->orderBy('registration_number','asc')->get();
        $this->trailers = Trailer::where('company_id',Auth::user()->company_id)->orderBy('registration_number','asc')->get();
        $this->currencies = Currency::orderBy('name','asc')->get();
        $this->countries = Country::where('status',1)->orderBy('name','asc')->get();
        $this->services = Service::orderBy('name','asc')->get();
        $this->wallets = Wallet::where('company_id',Auth::user()->company_id)->get();
        $this->uniqueid = $this->generatePIN();
        $this->transaction_type = TransactionType::where('name','Service Order')->first();
        $this->charge = $this->transaction_type->charge;
    }

    public function orderNumber(){

        $initials = 'F365';

            $order = Order::orderBy('id','desc')->where('company_id', Auth::user()->company_id)->first();

        if (!$order) {
            $order_number =  $initials .'O'. str_pad(1, 5, "0", STR_PAD_LEFT);
        }else {
            $number = $order->id + 1;
            $order_number =  $initials .'O'. str_pad($number, 5, "0", STR_PAD_LEFT);
        }

        return  $order_number;


    }

    public function updatedSelectedHorse($id){
        if (!is_null($id)) {
            $this->horse = Horse::find($id);
            $this->selected_horse = Horse::find($id);
            $horse_trailers =  $this->horse->trailers;
            if (isset($horse_trailers)) {
                foreach ($horse_trailers as $trailer) {
                    $this->trailer_id[] = $trailer->id;
                }
            }
        }
    }

    public function setService($id){
        if (in_array($id, $this->opened_service_ids)) {
            // Remove the ID if it exists
            $this->opened_service_ids = array_diff($this->opened_service_ids, [$id]);
        } else {
            // Add the ID if it doesn't exist
            $this->opened_service_ids[] = $id;
        }
    }

    public function updatedSelectedWallet($id){
        if (!is_null($id)) {
            $this->selected_wallet = Wallet::find($id);
            $this->currency_id = $this->selected_wallet->currency_id;
            $this->selected_currency = $this->selected_wallet->currency;
        }
    }
    public function updatedSelectedDriver($id){
        if (!is_null($id)) {
            $this->selected_driver = Driver::find($id);
        }
    }

    public function updatedSelectedCountry($id){
        if (!is_null($id)) {
            $this->country = Country::find($id);
            $this->selected_country = Country::find($id);
            $this->service_providers = $this->country->service_providers;
        }
    }

    public function generatePIN($digits = 4){
        $i = 0; //counter
        $pin = ""; //our default pin is blank.
        while($i < $digits){
            //generate a random number between 0 and 9.
            $pin .= mt_rand(0, 9);
            $i++;
        }
        return $pin;
    }

    public function nextStep(){
      
        $this->next = True;
    }

    public function placeOrder($service_id, $category, $id)
    {
        // Delete existing order item if any
        $previous_order_item = OrderItem::where('uniqueid', $this->uniqueid)->first();
        if ($previous_order_item) {
            $previous_order_item->delete();
        }

        // Create new order item
        $order_item = new OrderItem;
        $order_item->uniqueid = $this->uniqueid;
        $order_item->service_id = $service_id;

        // Dynamically set the category-specific foreign key
        switch ($category) {
            case 'branch':
                $order_item->branch_id = $id;
                break;
            case 'fuel_station':
                $order_item->fuel_station_id = $id;
                break;
            case 'office':
                $order_item->office_id = $id;
                break;
            default:
                throw new \Exception("Invalid category provided: {$category}");
        }

        $order_item->save();
        $this->order_item = $order_item;
    }
 
    public function unPlaceOrder($service_id, $category, $id)
    {
        // Map category to the corresponding column
        $categoryColumns = [
            'branch' => 'branch_id',
            'fuel_station' => 'fuel_station_id',
            'office' => 'office_id'
        ];

        if (!array_key_exists($category, $categoryColumns)) {
            throw new \Exception("Invalid category provided: {$category}");
        }

        $column = $categoryColumns[$category];

        $order_item = OrderItem::where('uniqueid', $this->uniqueid)
            ->where($column, $id)
            ->where('service_id', $service_id)
            ->first();

        if ($order_item) {
            $order_item->delete();
        }
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


    public function createOrder(){

             if (!$this->order_item) {
                 $this->dispatch(
                    'alert',
                    type : 'error',
                    title : "Please select & place an order before creating an order !!",
                    position: "center",
                );

                return;
             }
                
                    $order = new Order;
                    $order->user_id = Auth::user()->id;
                    $order->order_number = $this->orderNumber();
                    $order->company_id = Auth::user()->company_id;
                    $order->horse_id = $this->selectedHorse;
                    $order->driver_id = $this->selectedDriver;
                    $order->country_id = $this->selectedCountry;
                    $order->wallet_id = $this->selectedWallet;
                    $order->currency_id = $this->currency_id;
                    $order->collection_date = $this->collection_date;
                    $order->total = $this->total;
                    $order->save();
                    $order->trailers()->sync($this->trailer_id);

                    $order_item = $this->order_item;
                    if (isset($order_item)) {
                            $order_item->order_id = $order->id;
                            $order_item->qty = $this->amount;
                            $order_item->amount = $this->total;
                            $order_item->collection_date = $order->collection_date;
                            $order_item->update();
                    }

                    $transaction = new Transaction;
                    $transaction->transaction_number = $this->transactionNumber();
                    $transaction->user_id = Auth::user()->id;
                    $transaction->order_id = $order->id;
                    $transaction->company_id = Auth::user()->company_id;
                    $transaction->wallet_id = $this->selectedWallet;
                    $transaction->movement = "Dbt";
                    $transaction->transaction_date = date('Y-m-d');
                    $transaction->transaction_type_id =  $this->transaction_type->id;
                    $transaction->amount = $this->total;
                    $transaction->currency_id = $this->currency_id;
                    $transaction->save();
                    
                    $this->dispatch(
                        'alert',
                        type : 'success',
                        title : "Order Created Successfully!!",
                        position: "center",
                    );

                    return redirect()->route('orders.index');
           
    }


    public function store()
    {
        $wallet = $this->selected_wallet;

        if (!$wallet || !$this->total) {
            return;
        }

        $total = floatval($this->total); // ensure it's numeric

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

            $this->createOrder(); // Order is allowed within overdraft
            return;
        }

        // No overdraft, check balance only
        if (is_numeric($wallet->balance) && is_numeric($total) && $wallet->balance >= $total) {
            $this->createOrder();
        } else {
            $this->dispatch(
                'alert',
                type: 'error',
                title: "You have insufficient wallet funds to create this order!!",
                position: "center",
            );
        }
    }
    
    

    public function render()
    {
        if (isset($this->order_item)) {
            if ($this->order_item->fuel_station) {
                if ((isset($this->amount) && is_numeric($this->amount)) && isset($this->order_item->fuel_station->fuel_price->retail_price) && is_numeric($this->order_item->fuel_station->fuel_price->retail_price)) {
                    $this->total = $this->amount * $this->order_item->fuel_station->fuel_price->retail_price;
                }
            }elseif ($this->order_item->office) {
                if ((isset($this->amount) && is_numeric($this->amount)) && isset($this->order_item->office->rate) && is_numeric($this->order_item->office->rate)) {
                    $this->total = $this->amount * $this->order_item->office->rate;
                }
            }elseif ($this->order_item->branch) {
                if ((isset($this->amount) && is_numeric($this->amount)) && isset($this->charge->percentage) && is_numeric($this->charge->percentage)) {
                    $this->charge_amount = ($this->charge->percentage/100) * $this->amount;
                    $this->total = $this->amount + $this->charge_amount;
                }
            }
        }
        
       
        return view('livewire.orders.create');
    }
}
