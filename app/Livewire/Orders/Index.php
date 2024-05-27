<?php

namespace App\Livewire\Orders;

use App\Models\Horse;
use App\Models\Order;
use App\Models\Driver;
use App\Models\Trailer;
use Livewire\Component;
use App\Models\Currency;
use App\Models\Customer;

class Index extends Component
{

    public $orders;


    public function mount(){
        $this->orders = Order::orderBy('created_at','desc')->get();

      
    }

    public function render()
    {
        return view('livewire.orders.index');
    }
}
