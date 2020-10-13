<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Defaultsubject extends Model
{
    use HasFactory; 

    protected $guarded = [
        'id'        
    ];

    public function sclass() 
    {
        return $this->belongsTo('App\Sclass');
    }

    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }
}
