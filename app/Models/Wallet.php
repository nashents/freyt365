<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wallet extends Model
{
    use HasFactory, SoftDeletes;

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function currency(){
        return $this->belongsTo('App\Models\Currency');
    }
    public function transactions(){
        return $this->hasMany('App\Models\Transaction');
    }
    public function orders(){
        return $this->hasMany('App\Models\Order');
    }

}
