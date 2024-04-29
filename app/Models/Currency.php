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
    
    public function fuel_prices(){
        return $this->hasMany('App\Models\FuelPrice');
    }
   
    public function bank_accounts(){
        return $this->hasMany('App\Models\BankAccount');
    }
    public function transactions(){
        return $this->hasMany('App\Models\Transaction');
    }

    public function branches(){
        return $this->belongsToMany('App\Models\Branch');
    }
}
