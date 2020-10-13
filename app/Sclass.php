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
    public function defaultsubjects()
    {
        return $this->hasMany('App\Defaultsubject');
    }
 
    public function practiceQuestions()
    {
        return $this->hasMany('App\PracticeQuestion');
    }

    public function classTeacher($section_id, $school_id )
    {        
        $classTecher = SchoolTeacherRelation::where([['school_id', '=', $school_id], ['sclass_id', '=', $this->id], ['section_id', '=', $section_id], ['classteacher', '=', 1],['approved', '=', 1]])->first();
        return $classTecher;
    }
    public function StudentCountClass($section_id, $school_id )
    {        
       $studentCount = Student::where([['school_id', '=', $school_id], ['sclass_id', '=', $this->id], ['section_id', '=', $section_id], ['approved', '=', 1]])->get();
       return $studentCount->count();
    }

    // public function classHomeworks($section_id, $school_id )
    // {        
    //    $homeworks = Homework::where([['school_id', '=', $school_id], ['sclass_id', '=', $this->id], ['section_id', '=', $section_id]])->get();
    //    return $homeworks;
    // }

}
