<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    use HasFactory, SoftDeletes;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function order_items(){
        return $this->hasMany('App\Models\OrderItem');
    }
    public function country(){
        return $this->belongsTo('App\Models\Country');
    }
    public function currencies(){
        return $this->belongsToMany('App\Models\Currency');
    }
    public function fuel_types(){
        return $this->belongsToMany('App\Models\FuelType');
    }
    public function services(){
        return $this->belongsToMany('App\Models\Service');
    }
    public function working_schedule(){
        return $this->hasOne('App\Models\WorkingSchedule');
    }

}
