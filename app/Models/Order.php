<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function country(){
        return $this->belongsTo('App\Models\Country');
    }
    public function horse(){
        return $this->belongsTo('App\Models\Horse');
    }
    public function fuel_price(){
        return $this->belongsTo('App\Models\FuelPrice');
    }
    public function service_provider(){
        return $this->belongsTo('App\Models\ServiceProvider');
    }
}
