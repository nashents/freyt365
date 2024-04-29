<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vendor extends Model
{
    use HasFactory, SoftDeletes;

    public function vendor_type(){
        return $this->belongsTo('App\Models\VendorType');
    }

    public function services(){
        return $this->belongsToMany('App\Models\Service');
    }

}
