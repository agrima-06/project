<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [
        'name', 'country', 'state', 'city', 'address', 'affilated_to', 'class_id', 'approved'
    ];

    public function students()
    {
        return $this->hasMany('App\Student');
    }
    public function schoolstaffs()
    {
        return $this->hasMany('App\Schoolstaff');
    }
    public function teachers()
    {
        return $this->hasMany('App\Teacher');
    }
    public function schoolTeacherRelations()
    {
        return $this->hasMany('App\SchoolTeacherRelation');
    }

    public function classes() 
    {
        $school_id = $this->id;
        $SchoolTeacherRelations = SchoolTeacherRelation::select('sclass_id')->where('school_id', '=', $school_id)->distinct()->get();
        return $SchoolTeacherRelations;
    }

    public function sections() 
    {
        $school_id = $this->id;
        $SchoolTeacherRelations = SchoolTeacherRelation::select('section_id')->where('school_id', '=', $school_id)->distinct()->get(); 
        return $SchoolTeacherRelations;
    }

}
