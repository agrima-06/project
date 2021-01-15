<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PracticeQuestionHindi extends Model
{
    use HasFactory;

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

    public function comprehensive()
    {
        return $this->belongsTo('App\ComprehensiveQuestions');
    }

    public function eversion()
    {
        return $this->hasOne('App\PracticeQuestion', 'hversion_id');
    }
    // public function sclass()
    // {
    //     return $this->belongsTo('App\Sclass');
    // }
}
