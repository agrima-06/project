<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PracticeQuestion extends Model
{
	protected $guarded = [
	        'id'        
	    ];
    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }
    public function sclass()
    {
        return $this->belongsTo('App\Sclass');
    }
    public function answer()
    {
        return $this->belongsTo('App\PracticeAnswer');
    }
    public function topic()
    {
        return $this->belongsTo('App\Topic');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    // public function sclass()
    // {
    //     return $this->belongsTo('App\Sclass');
    // }
}
