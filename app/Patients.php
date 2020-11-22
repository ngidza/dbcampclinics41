<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    protected $fillable = [
        'patient_name','patient_dob','patient_no','patient_addres','reference_id',
        'classification_id','medical_id','date_dignised','clinic_test_id',
                     ];
}
