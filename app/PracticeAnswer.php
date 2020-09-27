<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PracticeAnswer extends Model
{
	protected $guarded = [
	        'id'        
	    ];
     public function practiceQuestion()
    {
        return $this->hasOne('App\PracticeQuestion', 'answer_id');
    }
  
}
