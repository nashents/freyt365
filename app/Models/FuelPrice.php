<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FuelPrice extends Model
{
    use HasFactory, SoftDeletes;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function country(){
        return $this->belongsTo('App\Models\Country');
    }
    public function currency(){
        return $this->belongsTo('App\Models\Currency');
    }
    public function fuel_station(){
        return $this->belongsTo('App\Models\FuelStation');
    }
    public function fuel_type(){
        return $this->belongsTo('App\Models\FuelType');
    }

    protected $fillable = [
        'fuel_station_id',
        'user_id',
        'country_id',
        'currency_id',
        'fuel_type_id',
        'pump_price',
        'retail_price',
        'stock_level',
        'description',
        'status',
    ];

}
