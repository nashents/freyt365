<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HorseMake extends Model
{
    use HasFactory, SoftDeletes;

    public function horses(){
        return $this->hasMany('App\Models\Horse');
    }
    public function horse_models(){
        return $this->hasMany('App\Models\HorseModel');
    }
}
