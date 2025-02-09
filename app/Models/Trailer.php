<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trailer extends Model
{
    use HasFactory, SoftDeletes;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function driver(){
        return $this->belongsTo('App\Models\Driver');
    }
    public function horse(){
        return $this->belongsTo('App\Models\Horse');
    }
    public function orders(){
        return $this->belongsToMany('App\Models\Order');
    }

    public function trips(){
        return $this->belongsToMany('App\Models\Trip');
    }
}
