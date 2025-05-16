<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'active',
        'is_admin',
        'category',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function is_admin(){
        if($this->is_admin){
            return true;
        }else{
            return false;
        }

    }

    public function overdrafts(){
        return $this->hasMany('App\Models\Overdraft');
    }
  
    public function requisitions(){
        return $this->hasMany('App\Models\Requisition');
    }
    public function offices(){
        return $this->hasMany('App\Models\Office');
    }
    public function service_providers(){
        return $this->hasMany('App\Models\ServiceProvider');
    }
    public function charges(){
        return $this->hasMany('App\Models\Charges');
    }
    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
 
    public function quotations(){
        return $this->hasMany('App\Models\Quotation');
    }

    public function fuel_prices(){
        return $this->hasMany('App\Models\FuelPrice');
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
    public function transactions(){
        return $this->hasMany('App\Models\Transaction');
    }
    public function fuel_station(){
        return $this->hasMany('App\Models\FuelStation');
    }
    public function bank_accounts(){
        return $this->hasMany('App\Models\BankAccount');
    }
    public function fuel_type(){
        return $this->hasMany('App\Models\FuelType');
    }
    public function employee(){
        return $this->hasOne('App\Models\Employee');
    }
    public function driver(){
        return $this->hasOne('App\Models\Driver');
    }
    public function accounts(){
        return $this->hasMany('App\Models\Account');
    }
  
  
    public function loading_points(){
        return $this->hasMany('App\Models\LoadingPoint');
    }
    public function offloading_points(){
        return $this->hasMany('App\Models\OffloadingPoint');
    }
    public function deductions(){
        return $this->hasMany('App\Models\Deduction');
    }
    public function cargos(){
        return $this->hasMany('App\Models\Cargo');
    }
  
    public function vendor(){
        return $this->hasOne('App\Models\Vendor');
    }
    public function broker(){
        return $this->hasOne('App\Models\Broker');
    }
    public function invoices(){
        return $this->hasMany('App\Models\Invoice');
    }
  
    public function customer(){
        return $this->hasOne('App\Models\Customer');
    }
    public function invoice_trips(){
        return $this->hasMany('App\Models\InvoiceTrip');
    }
    public function vehicles(){
        return $this->hasMany('App\Models\Vehicle');
    }
    public function trailers(){
        return $this->hasMany('App\Models\Trailer');
    }
    public function bookings(){
        return $this->hasMany('App\Models\Booking');
    }
    public function admin(){
        return $this->hasOne('App\Models\Admin');
    }
   
    public function fitnesses(){
        return $this->hasMany('App\Models\Fitness');
    }
    public function notices(){
        return $this->hasMany('App\Models\Notice');
    }
    public function inspections(){
        return $this->hasMany('App\Models\Inspection');
    }
    public function trips(){
        return $this->hasMany('App\Models\Trip');
    }
    public function horses(){
        return $this->hasMany('App\Models\Horse');
    }
    public function permissions(){
        return $this->hasMany('App\Models\Permission');
    }
    public function fuels(){
        return $this->hasMany('App\Models\Fuel');
    }
    public function leaves(){
        return $this->hasMany('App\Models\Leave');
    }
    public function branches(){
        return $this->hasMany('App\Models\Branch');
    }
    public function departments(){
        return $this->hasMany('App\Models\Department');
    }
    public function mails(){
        return $this->hasMany('App\Models\Mail');
    }
    public function roles(){
        return $this->belongsToMany('App\Models\Role');
    }
}
