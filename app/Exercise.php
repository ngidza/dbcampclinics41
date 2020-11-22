<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = [
        'patient_id','activity_id', 'distance','value'
    ];

}
