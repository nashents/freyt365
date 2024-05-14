<?php

namespace App\Livewire\Orders;

use App\Models\Order;
use Livewire\Component;

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
