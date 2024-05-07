<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorkingSchedule extends Model
{
    use HasFactory, SoftDeletes;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function branch(){
        return $this->belongsTo('App\Models\Branch');
    }
    public function vendor(){
        return $this->belongsTo('App\Models\Vendor');
    }
    public function fuel_station(){
        return $this->belongsTo('App\Models\FuelStation');
    }
}
