<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [
        'id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function sclass()
    {
        return $this->belongsTo('App\Sclass');
    }
    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    public function school()
    {
        return $this->belongsTo('App\School');
    }

    // public function subjects()
    // {
    //     return $this->belongsToMany('App\Subject');
    // }

    public function relations()
    {
        $school_id = auth()->user()->student->school_id;
        $sclass_id = auth()->user()->student->sclass_id;
        $section_id = auth()->user()->student->section_id;         
        $SchoolTeacherRelations = SchoolTeacherRelation::where([['school_id', '=', $school_id], ['sclass_id', '=', $sclass_id], ['section_id', '=', $section_id]])->get();
        return $SchoolTeacherRelations;
    }
}