<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homeworkfile extends Model
{
   
    protected $guarded = [
        'id'        
    ];

    public function homework()
    {
        return $this->belongsTo('App\Homework');
    }
}
