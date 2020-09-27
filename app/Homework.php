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

    public function User()
	{
        return $this->belongsTo('App\User');
	}

    public function sclass()
    {
        return $this->belongsTo('App\Sclass');
    }

    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }
}
