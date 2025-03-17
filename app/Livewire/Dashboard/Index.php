<?php

namespace App\Livewire\Dashboard;

use App\Models\Trip;
use App\Models\User;
use App\Models\Horse;
use App\Models\Order;
use App\Models\Driver;
use App\Models\Wallet;
use App\Models\Company;
use App\Models\Trailer;
use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $companies;
    public $users;
    public $trailers;
    public $drivers;
    public $horses;
    public $trips;
    public $newest_orders;
    public $latest_orders;
    public $orders;
    public $all_authorized_orders_count;
    public $transactions;
    public $wallet;

    public function mount(){
        $this->wallet = Wallet::where('company_id',Auth::user()->company_id)->where('default',True)->first();
        $this->companies = Company::latest()->take(5)->get();
        $this->users = User::latest()->take(5)->get();
        $this->transactions = Transaction::where('authorization','approved')->orderBy('created_at','desc')->take(5)->get();
        $this->drivers = Driver::latest()->take(5)->get();
        $this->horses = Horse::latest()->take(5)->get();
        $this->trailers = Trailer::latest()->take(5)->get();
        $this->trips = Trip::latest()->take(5)->get();
        $this->orders = Order::where('authorization','approved')->orderBy('created_at','desc')->take(5)->get();
        $this->all_authorized_orders_count = Order::where('company_id',Auth::user()->company_id)->whereYear('created_at',date('Y'))->where('authorization','approved')->get()->count();
        $this->newest_orders = Order::where('company_id',Auth::user()->company_id)->orderBy('created_at','desc')->take(5)->get();
        $this->latest_orders = Order::where('company_id',Auth::user()->company_id)->orderBy('created_at','desc')->where('status','successful')->take(5)->get();
    }

    public function render()
    {
        return view('livewire.dashboard.index');
    }
}
