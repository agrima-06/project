<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schoolstaff extends Model
{
    protected $guarded = [
	        'id'        
	    ]; 
	public function school()
    {
        return $this->belongsTo('App\School');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}



