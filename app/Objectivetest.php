<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objectivetest extends Model
{
    use HasFactory;
     protected $guarded = [
        'id'
    ];

    
    public function testquestions()
    {
        return $this->hasMany('App\Testquestion');
    }

    public function testresults()
    {
        return $this->hasMany('App\Testresult');
    }

    public function testshareds()
    {
        return $this->hasMany('App\Testshared');
    }

    public function user()
    {
        return $this->belongsTo('App\user');
    }

    public function promotions()
    {
        return $this->hasOne(Objectivetestpromotion::class);
    }
}
