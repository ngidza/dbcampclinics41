<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weist extends Model
{
    protected $fillable = [
        'patient_id', 'meals_id', 'value'
    ];
}
