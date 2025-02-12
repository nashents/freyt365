<?php

namespace App\Models;

use App\Events\TransactionCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    // protected $dispatchesEvents = [
    //     'created' => TransactionCreated::class,
    // ];

    public function currency(){
        return $this->belongsTo('App\Models\Currency');
    }
    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function order(){
        return $this->belongsTo('App\Models\Order');
    }
    public function transaction_type(){
        return $this->belongsTo('App\Models\TransactionType');
    }
    public function charge(){
        return $this->belongsTo('App\Models\Charge');
    }
    public function wallet(){
        return $this->belongsTo('App\Models\Wallet');
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
