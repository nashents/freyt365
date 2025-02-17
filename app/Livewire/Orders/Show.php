<?php

namespace App\Livewire\Orders;

use App\Models\Order;
use Livewire\Component;

class Show extends Component
{
    public $order;
    public $order_id;

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

    public function mount($id){
        $this->order = Order::find($id);
        $this->order_item = $this->order->order_item;
        $this->selected_currency = $this->order->currency;
        $this->transaction_type = $this->order->transaction->transaction_type;
        $this->selected_wallet = $this->order->wallet;
        $order_trailers = $this->order->trailers;
        if (isset($order_trailers)) {
            foreach ($order_trailers as $trailer) {
                $this->trailer_id[] = $trailer->id;
            }
        }
    }
    public function render()
    {
        return view('livewire.orders.show');
    }
}
