<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Currency extends Model
{
    use HasFactory, SoftDeletes;

    public function wallets(){
        return $this->hasMany('App\Models\Wallet');
    }
    public function orders(){
        return $this->hasMany('App\Models\Orders');
    }
    
    public function fuel_prices(){
        return $this->hasMany('App\Models\FuelPrice');
    }
   
    public function bank_accounts(){
        return $this->hasMany('App\Models\BankAccount');
    }
    public function transactions(){
        return $this->hasMany('App\Models\Transaction');
    }

  
    public function service_providers(){
        return $this->belongsToMany('App\Models\ServiceProvider');
    }
    public function fuel_stations(){
        return $this->belongsToMany('App\Models\FuelStation');
    }
    public function offices(){
        return $this->belongsToMany('App\Models\Office');
    }

    public function branches(){
        return $this->belongsToMany('App\Models\Branch');
    }
    public function trips(){
        return $this->hasMany('App\Models\Trip');
    }
    public function invoices(){
        return $this->hasMany('App\Models\Invoice');
    }
}
