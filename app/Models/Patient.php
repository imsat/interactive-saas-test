<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime'
    ];


//    public function doctor(){
//        return $this->hasOne(Arzte::class, 'id', 'doctor_id');
//    }
//
//    public function rechnung(){
//        return $this->hasOne(FremdanteilBill::class, 'patient_id', 'id')->latest();
//    }
//
//    public function rechnungData(){
//        return $this->hasOne(FremdanteilBill::class, 'patient_id', 'id')->latest();
//    }


    public function getProfileStatusAttribute($value){
        if($value == 1){
            return 'Enabled';
        }else{
            return 'Disabled';
        }
    }
    public function getPatientArchiveActiveAttribute($value){
        if($value == 1){
            return 'Enabled';
        }else{
            return 'Disabled';
        }
    }

    public function getDeactiveAlarmAttribute($value){
        if($value == 1){
            return 'Enabled';
        }else{
            return 'Disabled';
        }
    }

    public function setInfoMakerAttribute($value){
        if($value){
            $this->attributes['info_maker'] = 1;
        }else{
            $this->attributes['info_maker'] = 0;
        }
    }

//    public function infoDetails()
//    {
//        return $this->hasMany(Patientinfomation::class, 'patient_id')->where('vhp', 0);
//    }
//
//    public function infoVhpDetails()
//    {
//        return $this->hasMany(Patientinfomation::class, 'patient_id')->where('vhp', 'vhp');
//    }
//
//
//
//    public function timeSheet(){
//        return $this->hasMany(EmployeeTimeSheet::class,'patient_id', 'id');
//    }
//
//    public function TimeTravel(){
//        return $this->hasMany(TimeTravel::class,'patient_id', 'id');
//    }
//
//    public function TimeTravelDriveCost(){
//        return $this->hasMany(TimeTravel::class,'patient_id', 'id')->where('ride_cost', 1);
//    }
//
//
//    public function timeSheetDriveCost(){
//        return $this->hasMany(EmployeeTimeSheet::class,'patient_id', 'id')->where('ride_cost', 1);
//    }
//
//    public function insuranceDetails(){
//        return $this->belongsTo(Insurance::class,'insurance_id');
//    }
//
//    public function remainders(){
//        return $this->hasMany(Remainder::class,'patient_id');
//    }
//
//
//    public function documents(){
//        return $this->hasMany(PatientPdf::class,'patient_id');
//    }
//
//
//    // relative address
//
//    public function relativeAddress(){
//        return $this->hasMany(PatientRelativeAddress::class,'patient_id');
//    }
//
//    // relative address
//
//    public function showRelativeAddress(){
//        return $this->hasOne(PatientRelativeAddress::class,'patient_id');
//    }
//
//    /**
//     * Check for a patient event have or not in future date
//     */
//    public function futureEvent()
//    {
//        return $this->hasMany(Calender::class, 'patient_id', 'id');
//    }
//
//
//    /**
//     * Check for a patient event have or not in future date
//     */
//    public function futureSingle()
//    {
//        return $this->hasMany(Calender::class, 'patient_id', 'id');
//    }
//
//
//    /**
//     * Check for a patient event have or not in future date
//     */
//    public function getCalendar()
//    {
//        return $this->hasOne(Calender::class, 'patient_id', 'id');
//    }
//
//    public function events(){
//        return $this->hasMany(Calender::class, 'patient_id', 'id');
//    }
//
//
//    public function eventBooks(){
//        return $this->hasMany(EventCalendar::class, 'patient_id', 'id');
//    }


    public function insurance(){
        return $this->belongsTo(Insurance::class, 'insurance_id', 'id');
    }

    public function insurance1(){
        return $this->belongsTo(Insurance::class, 'insurance_id_1', 'id');
    }

    public function insurance2(){
        return $this->belongsTo(Insurance::class, 'insurance_id_2', 'id');
    }

    public function insurance3(){
        return $this->belongsTo(Insurance::class, 'insurance_id_3', 'id');
    }

    public function insurance4(){
        return $this->belongsTo(Insurance::class, 'insurance_id_4', 'id');
    }


//    public function CertificateAchivement(){
//        return $this->hasOne(CertificateAchivement::class, 'id', 'certificate_of_achivement');
//    }
//
//
//    public function price(){
//        return $this->hasOne(Price::class, ['billing_id','cerifificate'], ["billing_id", "certificate_of_achivement"] );
//    }
//
//    public function rideCost(){
//        return $this->hasOne(Price::class, ['billing_id','cerifificate'], ["billing_id", "certificate_of_achivement"]);
//
//    }
//
//    // new event calendar function ride cost goes here
//    public function bookedEventCostRide(){
//        return $this->hasMany(EmployeeBooked::class, 'patient_id', 'id');
//    }
//
//    // new event calendar function general cost goes here
//    public function bookedEventCost(){
//        return $this->hasMany(EmployeeBooked::class, 'patient_id', 'id');
//    }
//
//
//    public function care(){
//        return $this->hasOne(CareLabel::class, 'id', 'care_level');
//    }
//
//
//    public function fremdanteilBill(){
//        return $this->hasOne(FremdanteilBill::class, 'patient_id', 'id');
//    }
//
//    public function generateBills(){
//        return $this->hasOne(GeneralBill::class, 'patient_id', 'id');
//    }
//
//    // hasMany
//    public function fremdanteilBills(){
//        return $this->hasMany(FremdanteilBill::class, 'patient_id', 'id');
//    }
//
//    public function generalBills(){
//        return $this->hasMany(GeneralBill::class, 'patient_id', 'id');
//    }
//
//
//    public function payment(){
//        return $this->belongsTo(Status::class, 'payment_status', 'id');
//    }
//
//
//    public function log_bills(){
//        return $this->belongsTo(BillNote::class, 'patient_id', 'patient_id');
//    }
//
//
//    public function dataVhp(){
//        return $this->belongsTo(VHPModel::class, 'vhp', 'id');
//    }
//
//
//    public function updateBill(){
//        return $this->hasMany(BillUpdate::class, 'patient_id', 'id')->latest();
//    }
//
//
//    public function updateBillCheck(){
//        return $this->hasOne(BillUpdate::class, 'patient_id', 'id')->latest();
//    }




}
