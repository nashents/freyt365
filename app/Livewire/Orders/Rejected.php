<?php

namespace App\Livewire\Orders;

use App\Models\Order;
use App\Models\Company;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TransactionVerificationMail;

class Rejected extends Component
{

    public $orders;
    public $order;
    public $order_id;
    public $authorization;
    public $authorized_by_id;
    public $reason;
    public $admin;


    public function mount(){
        $this->admin = Company::where('type','admin')->first();
        $this->orders = Order::where('company_id', Auth::user()->company->id)->where('authorization','rejected')->orderBy('created_at','desc')->get();

    }

    private function resetInputFields(){

        $this->authorization = "";
        $this->reason = "";
       
    }

    public function updated($value){
        $this->validateOnly($value);
    }
    protected $rules = [
        'authorization' => 'required',
        'reason' => 'nullable',
    ];

    function generateTransactionReference($length = 6) {
        // Characters to use in the code
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomCode = '';
    
        // Generate the random code
        for ($i = 0; $i < $length; $i++) {
            $randomCode .= $characters[rand(0, $charactersLength - 1)];
        }
    
        return $randomCode;
    }


    public function showAuthorize($id){
        $this->order_id = $id;
        $this->order = Order::find($id);
        $this->dispatch('show-authorizationModal');
    }

    public function saveAuthorize(){
        $transaction = $this->order->transaction;
        $wallet = $transaction->wallet;

        if (!$wallet && ! $transaction) {
         
            $this->dispatch('hide-authorizationModal');
            $this->resetInputFields();
            $this->dispatch(
                'alert',
                type : 'error',
                title : "Something wrong with the order, delete and create a new one!!",
                position: "center",
            );

            return ;
        }
        
        if ((is_numeric($wallet->balance) && is_numeric($transaction->amount)) && $wallet->balance > $transaction->amount) {
            $order = Order::find($this->order_id);
            $order->authorized_by_id = Auth::user()->id;
            $order->authorization = $this->authorization;
            $order->reason = $this->reason;
            $order->update();

            $transaction->authorized_by_id = Auth::user()->id;
            $transaction->authorization = $this->authorization;
            $transaction->reason = $this->reason;
            $transaction->update();
            
            if ($this->authorization == "approved") {
               
                $transaction->transaction_reference = $this->generateTransactionReference();
                $transaction->update();
               
    
                if ($this->admin->email) {
                    Mail::to($this->admin->email)->send(new TransactionVerificationMail($transaction, $this->admin));
                }  
    
                 $this->dispatch('hide-authorizationModal');
                        $this->resetInputFields();
                        $this->dispatch(
                            'alert',
                            type : 'success',
                            title : "Order Approved Successfully!!",
                            position: "center",
                        );
                    return redirect()->route('orders.approved');
    
            }else{
                $this->dispatch('hide-authorizationModal');
                $this->resetInputFields();
                $this->dispatch(
                    'alert',
                    type : 'success',
                    title : "Order Rejected Successfully!!",
                    position: "center",
                );
                return redirect()->route('orders.rejected');
            }              
          
        }else{
            $this->dispatch('hide-authorizationModal');
            $this->resetInputFields();
            $this->dispatch(
                'alert',
                type : 'error',
                title : "You have insuffient funds to perform this order!!",
                position: "center",
            );      
        }
    
    }
    
    public function render()
    {
        return view('livewire.orders.rejected');
    }
}
