<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $fillable = [
        'patient_id', 'meals_id', 'food_type_id','notes',
    ];
}
