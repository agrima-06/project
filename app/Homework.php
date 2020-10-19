<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    protected $guarded = [
        'id'        
    ];

    public function Homeworkfiles()
    {
        return $this->hasMany('App\Homeworkfile');
    }

    public function teacher()
	{
        return $this->belongsTo('App\Teacher');
	}

    public function topic()
    {
        return $this->belongsTo('App\topic');
    }

    public function school()
    {
        return $this->belongsTo('App\School');
    }  

    public function sclass()
    {
        return $this->belongsTo('App\Sclass');
    }

    public function section()
    {
        return $this->belongsTo('App\Section');
    }


    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }
}
