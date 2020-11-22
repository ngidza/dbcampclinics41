<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    protected $fillable = [
        'patient_id', 'meals_id', 'weight','value' ,'temperature'
    ];

}
