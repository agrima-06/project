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

    
}
