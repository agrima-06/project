<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComprehensiveQuestions extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'        
    ];

    public function practiceQuestions()
    {
        return $this->hasMany('App\PracticeQuestion', 'comprehensive_id');
    }
}
