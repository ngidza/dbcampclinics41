<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    protected $fillable = [
        'patient_id', 'medicine_id', 'formula_id','dosage', 'notes'
    ];

}
