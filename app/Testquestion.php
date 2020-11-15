<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testquestion extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function objectivetest()
    {
        return $this->belongsTo('App\Objectivetest');
    }

    public function questions()
    {        
        $question = json_decode($this->question);

        // USE THIS METHOD TO GEMNERATE RANDOM QUESTION
  		// the Arr::shuffle method randomly shuffles the items in the array:
		// use Illuminate\Support\Arr;
		// $array = Arr::shuffle([1, 2, 3, 4, 5]);
		// // [3, 2, 5, 1, 4] - (generated randomly)


        $practicequestions = PracticeQuestion::whereIn('id',$question)->get();
        // dd($practicequestions);
     	// $practicequestions = homework::where('teacher_id', '=', $this->id)->get();
        return $practicequestions;
    }
}
