<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    public function branches(){
        return $this->belongsToMany('App\Models\Branch');
    }
    public function service_providers(){
        return $this->belongsToMany('App\Models\ServiceProvider');
    }
    public function fuel_stations(){
        return $this->belongsToMany('App\Models\FuelStation');
    }

    public function order_items(){
        return $this->hasMany('App\Models\OrderItem');
    }
    public function offices(){
        return $this->belongsToMany('App\Models\Office');
    }
    public function vendors(){
        return $this->belongsToMany('App\Models\Vendor');
    }
}
