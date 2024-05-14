<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function trips(){
        return $this->hasMany('App\Models\Trip');
    }
    public function invoices(){
        return $this->hasMany('App\Models\Invoice');
    }
}
