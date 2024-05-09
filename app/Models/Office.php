<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Office extends Model
{
    use HasFactory, SoftDeletes;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function service_provider(){
        return $this->belongsTo('App\Models\ServiceProvider');
    }
    public function vendor(){
        return $this->belongsTo('App\Models\Vendor');
    }
    
}
