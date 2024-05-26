<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function patientInsurance(){
        return $this->hasOne(Patient::class,'insurance_id');
    }
}
