<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Driver extends Model
{
    use HasFactory, SoftDeletes;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function trips(){
        return $this->hasMany('App\Models\Trip');
    }
    public function orders(){
        return $this->hasMany('App\Models\Order');
    }
    
}
