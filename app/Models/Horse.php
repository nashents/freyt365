<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Horse extends Model
{
    use HasFactory, SoftDeletes;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function horse_make(){
        return $this->belongsTo('App\Models\HorseMake');
    }
    public function horse_model(){
        return $this->belongsTo('App\Models\HorseModel');
    }
    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function trailers(){
        return $this->belongsToMany('App\Models\Trailer');
    }
    public function trips(){
        return $this->hasMany('App\Models\Trip');
    }
}
