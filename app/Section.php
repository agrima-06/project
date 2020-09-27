<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $guarded = [
        'id'        
    ];

    public function students()
    {
        return $this->hasMany('App\Student');
    }


    public function schoolTeacherRelations()
    {
        return $this->hasMany('App\SchoolTeacherRelation');
    }
}
