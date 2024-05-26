<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class YearReport extends Model
{
    use HasFactory, SoftDeletes;
    protected  $table = 'bills';

    protected $guarded = [];

    protected $casts = [
        'billing_address' => 'json',
    ];


//    public function price(){
//        return $this->belongsTo(Price::class, ["bill_group_id", "certificate_achivement_id"],  ['billing_id','cerifificate'] );
//    }

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function createdBy(){
        return $this->hasOne(User::class, 'id', 'created_by');
    }


//    public function receives()
//    {
//        return $this->hasMany(Receive::class, 'bill_id', 'serial_number');
//    }
//
//    public function fremdanteil(){
//        return $this->hasOne(FremdanteilBill::class, 'general_bill_number', 'serial_number');
//    }
//
//    // for year report
//    public function fremdanteilYerReport(){
//        return $this->hasOne(FremdanteilBill::class, 'serial_number', 'serial_number');
//    }
//
//    public function generalBill(){
//        return $this->hasOne(GeneralBill::class, 'serial_number', 'serial_number');
//    }
//
//    public function freamdantielLog(){
//        return $this->belongsTo(FremdanteilBill::class, 'serial_number', 'general_bill_number');
//    }
//
//
//    public function payment(){
//        return $this->belongsTo(Status::class, 'payment_status', 'id');
//    }
//
//    public function log(){
//        return $this->belongsTo(BillNote::class, 'serial_number', 'bill_namber');
//    }
//
//
//    public function billNote(){
//        return $this->hasMany(BillNote::class, 'bill_namber', 'serial_number');
//    }
}
