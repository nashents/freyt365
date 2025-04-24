<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory, SoftDeletes;

    public function bank_accounts(){
        return $this->hasMany('App\Models\BankAccount');
    }
    public function fuel_prices(){
        return $this->hasMany('App\Models\FuelPrice');
    }
    public function fuel_stations(){
        return $this->hasMany('App\Models\FuelStation');
    }
    public function branches(){
        return $this->hasMany('App\Models\Branch');
    }
    public function offices(){
        return $this->hasMany('App\Models\Office');
    }
}
