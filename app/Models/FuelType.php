<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FuelType extends Model
{
    use HasFactory, SoftDeletes;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function fuel_prices(){
        return $this->hasMany('App\Models\FuelPrice');
    }

    public function branches(){
        return $this->belongsToMany('App\Models\Branch');
    }
    public function service_providers(){
        return $this->belongsToMany('App\Models\ServiceProvider');
    }
    public function fuel_stations(){
        return $this->belongsToMany('App\Models\FuelStation');
    }
    
}
