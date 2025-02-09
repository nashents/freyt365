<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory, SoftDeletes;

    public function branch(){
        return $this->belongsTo('App\Models\Branch');
    }
    public function service(){
        return $this->belongsTo('App\Models\Service');
    }
    public function order(){
        return $this->belongsTo('App\Models\Order');
    }
    public function fuel_station(){
        return $this->belongsTo('App\Models\FuelStation');
    }
    public function office(){
        return $this->belongsTo('App\Models\Office');
    }
}
