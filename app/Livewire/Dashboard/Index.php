<?php

namespace App\Livewire\Dashboard;

use App\Models\Trip;
use App\Models\User;
use App\Models\Horse;
use App\Models\Order;
use App\Models\Driver;
use App\Models\Company;
use App\Models\Trailer;
use Livewire\Component;

class Index extends Component
{
    public $companies;
    public $users;
    public $trailers;
    public $drivers;
    public $horses;
    public $trips;
    public $orders;

    public function mount(){
        $this->companies = Company::latest()->take(5)->get();
        $this->users = User::latest()->take(5)->get();
        $this->drivers = Driver::latest()->take(5)->get();
        $this->horses = Horse::latest()->take(5)->get();
        $this->trailers = Trailer::latest()->take(5)->get();
        $this->trips = Trip::latest()->take(5)->get();
        $this->orders = Order::latest()->take(5)->get();
    }

    public function render()
    {
        return view('livewire.dashboard.index');
    }
}
