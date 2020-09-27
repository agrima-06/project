<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolTeacherRelation extends Model
{
 
    protected $guarded = [
        'id'        
    ];
    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }
    public function sclass()
    {
        return $this->belongsTo('App\Sclass');
    }
    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }
    public function school()
    {
        return $this->belongsTo('App\School');
    }
}
