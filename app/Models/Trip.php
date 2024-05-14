<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trip extends Model
{
    use HasFactory, SoftDeletes;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function horse(){
        return $this->belongsTo('App\Models\Horse');
    }
    public function driver(){
        return $this->belongsTo('App\Models\Driver');
    }
    public function currency(){
        return $this->belongsTo('App\Models\Currency');
    }
    public function customer(){
        return $this->belongsTo('App\Models\Customer');
    }
    public function trailers(){
        return $this->belongsToMany('App\Models\Trailer');
    }
}
