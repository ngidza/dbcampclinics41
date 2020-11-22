<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feet extends Model
{
    protected $fillable = [
        'patient_id', 'feet','next_visit','complications_id'
   ];
}
