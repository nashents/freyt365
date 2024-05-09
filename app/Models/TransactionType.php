<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionType extends Model
{
    use HasFactory, SoftDeletes;

    public function charge(){
        return $this->hasOne('App\Models\Charge');
    }
    public function transactions(){
        return $this->hasMany('App\Models\Transaction');
    }
}
