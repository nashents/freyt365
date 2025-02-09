<?php

namespace App\Livewire\Orders;

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

    public function delete($id){
        $order = Order::find($id);
        $transaction = $order->transaction;
      
        if (isset($transaction)) {
            $transaction->delete();
        }
       
        $order->delete();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Order Deleted Successfully!!",
            position: "center",
        );
    }

    public function render()
    {
        $this->orders = Order::orderBy('created_at','desc')->get();
        return view('livewire.orders.index',[
            'orders' => $this->orders
        ]);
    }
}
