<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Charge extends Model
{
    use HasFactory, SoftDeletes;

    public function transaction_type(){
        return $this->belongsTo('App\Models\TransactionType');
    }
    public function transactions(){
        return $this->hasMany('App\Models\Transaction');
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

}
