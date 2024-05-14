<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function trip(){
        return $this->belongsTo('App\Models\Trip');
    }
    public function currency(){
        return $this->belongsTo('App\Models\Currency');
    }
    public function customer(){
        return $this->belongsTo('App\Models\Customer');
    }
    public function bank_account(){
        return $this->belongsTo('App\Models\BankAccount');
    }
    public function invoice_items(){
        return $this->hasMany('App\Models\InvoiceItem');
    }
    public function invoice_payments(){
        return $this->hasMany('App\Models\InvoicePayment');
    }
    
}
