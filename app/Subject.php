<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
     protected $fillable = [
        'name', 'subject_id'
        ];

    public function sclasses()
    {
        return $this->belongsToMany('App\Sclass');
    }

    public function homeworks()
    {
        return $this->hasMany('App\Homework');
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

    public function topics()
    {
        return $this->hasMany('App\Topic');
    }

    public function defaultsubjects()
    {
        return $this->hasMany('App\Defaultsubject');
    }

    public function classSubjectHomeworks($school_id, $sclass_id, $section_id)
    {        
       $homeworks = Homework::where([['school_id', '=', $school_id], ['sclass_id', '=', $sclass_id], ['section_id', '=', $section_id], ['subject_id', '=', $this->id]])->get();
       return $homeworks;
    }


}
