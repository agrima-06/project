<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;

use App\PracticeQuestion;
use App\PracticeAnswer;
use App\Subject;
use App\School;
use App\Sclass;
//use App\DB;
use App\Topic;
use App\SchoolTeacherRelation;
use App\Schoolstaff;
use App\Homework;
use App\Teacher;
use App\Student;

use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
  
        if ( auth()->user()->role == 'admin') {            
          $schools = School::all();
          $practiceQuestions = PracticeQuestion::all();
          $homeworks = Homework::all();
          //dd($homeworks);
          $teachers = Teacher::all();
          $students = Student::all();
          //dd($school);
          return view('admin.home')->with('schools', $schools)->with('teachers', $teachers)->with('students', $students)->with('homeworks', $homeworks)->with('practiceQuestions', $practiceQuestions);            
        }

        elseif (auth()->user()->role == 'staff') {
          return view('admin.home');
        }

        elseif (auth()->user()->role == 'schoolstaff') { 
                
          $school = auth()->user()->schoolstaff->school;
         // dd($school);
          return view('schoolstaff.home')->with('school', $school);
        }

        elseif (auth()->user()->role == 'teacher') {
          $aboutme = auth()->user()->teacher;
          $school = auth()->user()->teacher->school;
          return view('teacher.home')->with('aboutme', $aboutme)->with('school', $school);           
        }
        elseif (auth()->user()->role == 'student') {
          $aboutme = auth()->user()->student;
          //dd($aboutme->relations()->subject);
          // $school_id = auth()->user()->student->school_id; 
          // $sclass_id = auth()->user()->student->sclass_id;
          // $section_id = auth()->user()->student->section_id;         
          // $SchoolTeacherRelations = SchoolTeacherRelation::where([['school_id', '=', $school_id], ['sclass_id', '=', $sclass_id], ['section_id', '=', $section_id]])->get();
           // dd(auth()->user()->student->relations);

          return view('/home')->with('aboutme', $aboutme);            
        }   
    }


    public function searchBar(Request $request){
        
        /*Search Functionality Working::
        If user Types single word:-
        a) Correct Word:- Search DB and find result 
        b) Mispelt Word:- Correct word  using  Soundex Function and find similar word result from DB.

        If user Types Phrase:-
        
        a) Check if each word is seperated by a single empty space else delete extra space.
        Then Search for complete phrase in DB, give this result priority of 1.
        b) Remove last word of phrase and seach again and store result by decreasing priority. 
        keep on searching when no word is left.
        c) Break the phrase into single single words, and correct the mispelt words and start searching each single word result as stated in logic of single word... Store all the result according to pririty in an Array and display.*/

          //     dd(request()->query('search'));

        //dd(soundex("Kno"));

        $search = request()->query('search');

        $practicequestions = PracticeQuestion::where('question', 'LIKE', "%{$search}%")->get();
        $homeworks = Homework::where('content', 'LIKE', "%{$search}%")->get();
       // $topics = Topic::where('topic', 'LIKE', "%{$search}%")->get();
        // $practicequestions = PracticeQuestion::where('question', 'Soundex()', "%{$search}%")->get();
       // $topics = Topic::where(soundex('trigonometry'), '=', Soundex($search))->get();
      $topics = DB::table('topics')->select(DB::raw('SELECT * FROM topics WHERE soundex(topics.topic)=soundex($search)'));

        dd($topics);
        //$practicequestion = PracticeQuestion::where('question', 'LIKE', "%{$search}%")->get();

      //  dd($practicequestions);
      //  dd($topic[0]->practiceQuestions[0]);

        return view('searchResult')->with('practicequestions', $practicequestions)->with('homeworks', $homeworks)->with('topics', $topics);

       // return redirect()->back();

        //AJAX Call
       if($request->ajax) {
                # code...
        }

        //Form Submitted
        elseif($request->q) {
            # code... 
        }
    }

}
