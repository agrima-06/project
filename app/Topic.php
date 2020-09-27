<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
	protected $guarded = [
	        'id'        
	    ];
	    
    public function practiceQuestions()
    {
        return $this->hasMany('App\PracticeQuestion');
    }

}
