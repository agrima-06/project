<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $guarded = [
        'id'
        ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function school()
    {
        return $this->belongsTo('App\School');
    }
    // public function sclass()
    // {
    //     return $this->belongsTo('App\Sclass');
    // }
    public function sclasses()
    {
        return $this->belongsToMany('App\Sclass');
    }
    public function subjects()
    {
        return $this->belongsToMany('App\Subject');
    }

    public function homeworks()
    {
        return $this->hasMany('App\Homework');
    }


    public function schoolTeacherRelations()
    {
        return $this->hasMany('App\SchoolTeacherRelation');
    }

    public function assignedRoles()
    {
        //$teacher_id = $this->id;
        $SchoolTeacherRelations = SchoolTeacherRelation::where('teacher_id', '=', $this->id)->get(); 
        // dd($SchoolTeacherRelations);
        return $SchoolTeacherRelations;
    }


    public function isClassTeacher($school_id)
    {        
        $classTecher = SchoolTeacherRelation::where([['school_id', '=', $school_id], ['teacher_id', '=', $this->id], ['classteacher', '=', 1], ['approved', '=', 1]])->first();
        return $classTecher;
    }
    
    public function iteachClasses()
    {   
       $school_id = $this->school_id;     
        $iteachClasses = SchoolTeacherRelation::select('id','school_id','sclass_id','subject_id','section_id', 'teacher_id')->where([['school_id', '=', $school_id], ['teacher_id', '=', $this->id], ['approved', '=', 1]])->get();
        return $iteachClasses;
    }

    public function practiceQuesPosted()
    {        
        $user_id = $this->user->id;
        $practiceQuestions = PracticeQuestion::where('user_id', '=' , $user_id)->get();
        return $practiceQuestions;
    }

    public function homeworksAssigned()
    {        
        $homeworks = homework::where('teacher_id', '=', $this->id)->get();
        return $homeworks;
    }

    
}
