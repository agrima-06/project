<?php

namespace App;
 
use Illuminate\Database\Eloquent\Model;

class Sclass extends Model
{
   protected $fillable = [
        'class', 'section', 'school_id', 'approved'
    ];

   public function students()
    {
        return $this->hasMany('App\Student');
    }
   public function homeworks()
    {
        return $this->hasMany('App\Homework');
    }
    public function subjects()
    {
        return $this->belongsToMany('App\Subject');
    }
    public function teachers()
    {
        return $this->belongsToMany('App\Teacher');
    }
    public function schoolTeacherRelations()
    {
        return $this->hasMany('App\SchoolTeacherRelation');
    }

    public function practiceQuestions()
    {
        return $this->hasMany('App\PracticeQuestion');
    }
}
