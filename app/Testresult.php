<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testresult extends Model
{
    use HasFactory;
         protected $guarded = [
        'id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function objectivetest()
    {
        return $this->belongsTo('App\Objectivetest');
    }

    public function testresults()
    {
        return $this->belongsTo('App\Testresult');
    }
}
