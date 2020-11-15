<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testshared extends Model
{
    use HasFactory;
     protected $guarded = [
        'id'
    ];
    public function objectivetest()
    {
        return $this->belongsTo('App\Objectivetest');
    }

    public function school()
    {
        return $this->belongsTo('App\School');
    }    

    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    public function sclass()
    {
        return $this->belongsTo('App\Sclass');
    }
}
