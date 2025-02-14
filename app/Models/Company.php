<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model  implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    public function is_admin(){
        if($this->is_admin){
            return true;
        }else{
            return false;
        }

    }

    public function users(){
        return $this->hasMany('App\Models\User');
    }
    public function transactions(){
        return $this->hasMany('App\Models\Transaction');
    }
    public function documents(){
        return $this->hasMany('App\Models\Document');
    }
    public function orders(){
        return $this->hasMany('App\Models\Order');
    }

    public function wallets(){
        return $this->HasMany('App\Models\Wallet');
    }

    public function drivers(){
        return $this->hasMany('App\Models\Driver');
    }
    public function horse(){
        return $this->hasMany('App\Models\Horse');
    }
    public function trailer(){
        return $this->hasMany('App\Models\Trailer');
    }
    public function receipts(){
        return $this->hasMany('App\Models\Receipt');
    }
    public function currency(){
        return $this->belongsTo('App\Models\Currency');
    }
    public function employees(){
        return $this->hasMany('App\Models\Employee');
    }
    public function fitnesses(){
        return $this->hasMany('App\Models\Fitness');
    }
    public function quotations(){
        return $this->hasMany('App\Models\Quotation');
    }
    public function credit_notes(){
        return $this->hasMany('App\Models\CreditNote');
    }
    public function bank_accounts(){
        return $this->hasMany('App\Models\BankAccount');
    }
    public function invoices(){
        return $this->hasMany('App\Models\Invoice');
    }
    public function customers(){
        return $this->hasMany('App\Models\Customer');
    }
    public function agents(){
        return $this->hasMany('App\Models\Agent');
    }
    public function transporters(){
        return $this->hasMany('App\Models\Transporter');
    }
    public function brokers(){
        return $this->hasMany('App\Models\Broker');
    }

    protected $fillable = [
        'user_id',
        'admin_id',
        'currency_id',
        'name',
        'type',
        'phonenumber',
        'email',
        'username',
        'country',
        'city',
        'suburb',
        'street_address',
    ];
}
