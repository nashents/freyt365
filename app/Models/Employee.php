<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model implements Auditable
{
    use HasFactory,SoftDeletes;

    use \OwenIt\Auditing\Auditable;

    public function vehicle_assignment(){
        return $this->hasMany('App\Models\VehicleAssignment');
    }
    public function checklists(){
        return $this->hasMany('App\Models\Checklist');
    }
    public function emails(){
        return $this->hasMany('App\Models\Email');
    }
    public function bookings(){
        return $this->belongsToMany('App\Models\Booking');
    }
    public function inspections(){
        return $this->belongsToMany('App\Models\Inspection');
    }
    public function tickets(){
        return $this->belongsToMany('App\Models\Ticket');
    }
    public function logs(){
        return $this->hasMany('App\Models\Log');
    }
    public function loans(){
        return $this->hasMany('App\Models\Loan');
    }
    public function documents(){
        return $this->hasMany('App\Models\Document');
    }
    public function salaries(){
        return $this->hasMany('App\Models\Salary');
    }
    public function payroll_salaries(){
        return $this->hasMany('App\Models\PayrollSalary');
    }
    public function currency(){
        return $this->belongsTo('App\Models\Currency');
    }
    public function asset_assignments(){
        return $this->belongsToMany('App\Models\AssetAssignment');
    }
    public function inventory_assignments(){
        return $this->hasMany('App\Models\InventoryAssignment');
    }
   
 
    public function cash_flows(){
        return $this->hasMany('App\Models\CashFlow');
    }
    public function asset_assignment(){
        return $this->hasMany('App\Models\AssetAssignment');
    }
    public function allocations(){
        return $this->hasMany('App\Models\Allocation');
    }
    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function department_head(){
        return $this->hasOne('App\Models\DepartmentHead');
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function ranks(){
        return $this->belongsToMany('App\Models\Rank');
    }
    public function departments(){
        return $this->belongsToMany('App\Models\Department');
    }
    public function branch(){
        return $this->belongsTo('App\Models\Branch');
    }
    public function driver(){
        return $this->hasOne('App\Models\Driver');
    }
  
    public function fuel_requests(){
        return $this->hasMany('App\Models\FuelRequest');
    }
    public function fuels(){
        return $this->hasMany('App\Models\Fuel');
    }
   

    protected $fillable = [ 
        'company_id',
        'creator_id',
        'user_id',
        'employee_number',
        'branch_id',
        'name',
        'middle_name',
        'surname',
        'dob',
        'gender',
        'post',
        'email',
        'pin',
        'idnumber',
        'phonenumber',
        'country',
        'city',
        'province',
        'suburb',
        'street_address',
        'start_date',   
        'duration',
        'expiration',
        'leave_days',
        'next_of_kin',
        'relationship',
        'contact',
        'status',
    ];
}
