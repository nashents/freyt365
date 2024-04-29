<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    public function branches(){
        return $this->belongsToMany('App\Models\Branch');
    }

    public function vendors(){
        return $this->belongsToMany('App\Models\Vendor');
    }
}
