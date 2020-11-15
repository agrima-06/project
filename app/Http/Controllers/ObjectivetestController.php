<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PracticeAnswer;
use App\PracticeQuestion;
use App\Objectivetest;
use App\Board;
use App\Subject;
use App\Testshared;
use App\Testquestion;
use App\SchoolTeacherRelation;
use Illuminate\Support\Facades\Session;


class ObjectivetestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        auth()->user()->id;
     //THIS CODE IS FOR RETReiving data from test and practice question DOnt Delete .  
    // $query = Objectivetest::find(1);
    // $array = json_decode($query->question);
    // $practicequestions = PracticeQuestion::whereIn('id',$array)->get();

      //$questions_id = [subject1_id:[11, 12, 13], subject1_id2:[11, 12, 13], subject1_id3:[11, 12, 13]];
        // $movies =array(
        //         "comedy" => array("Pink Panther", "John English", "See no evil hear no evil"),
        //         "action" => array("Die Hard", "Expendables"),
        //         "epic" => array("The Lord of the rings"),
        //         "Romance" => array("Romeo and Juliet")
        //         );

        //    $movies = [
        //     "comedy" => ["Pink Panther", "John English", "See no evil hear no evil"],
        //     "action" => ["Die Hard", "Expendables"],
        //     "epic" => ["The Lord of the rings"],
        //     "Romance" => ["Romeo and Juliet"]
        //     ];

        // foreach($age as $x => $values) {
        //     $y = '';
        //     foreach($values as $value){
        //          $y = $y.$value;
        //          }
        //       echo "Key=" . $x . ", Value=" . $y;
        //       echo "<br>";
        //     }



            // $questions = [
            // "English" => ["11", "12", "13"],
            // "Maths" => ["14", "15", "16"],
            // "GK" => ["17", "18", "19"],
            // "Reasoning" => ["20", "21", "22"]
            // ];


            // function array_push_assoc($array, $key, $value){
            //    $array[$key] = $value;
            //    return $array;
            // }


        // foreach($questions as $subject => $ids) {
        //   $subject = PracticeQuestion::whereIn('id', $ids)->get();

        // }

            // dd($subject);
            //$practicequestions = PracticeQuestion::whereIn('id',$array)->get();
//


     //    // $movies = json_decode($movies);
     //    dd($movies[key($movies)]);

     //    dd(count($movies));
     // // dd($movies['comedy']);
    // dd($practicequestions);


        //         $query = Objectivetest::find(1);
        // $array = json_decode($query->testquestions[1]->question);
        // $practicequestions = PracticeQuestion::whereIn('id',$array)->get();
        // dd($practicequestions);
       // $qarray = null;

        return view('test.testlist');


        $questions = "[1, 2 ,3]";

        $subject = 'English';
        $test_id = 1;

        $sessionKey = auth()->user()->id.'_'.$subject.'_'.$test_id;
       // $sessionKey = 'questions';
        Session::put($sessionKey, $questions);
        return view('test.test')->with('sessionKey', $sessionKey);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $boards= Board::all();
        if(auth()->user()->role = 'teacher'){
           // dd('teacher Acces');
            $classes = auth()->user()->teacher->iteachClasses();
            //dd($classes);
            $subjects = Subject::all();
        }
        elseif(auth()->user()->role = 'admin'){
            dd('admin');

        }
        return view('test.create')->with('boards', $boards)->with('classes', $classes)->with('subjects', $subjects);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        // dd($request->pu);
      //  $sharedWith = $request->shareWith[1];

      //  dd($sharedWith);
        //$title = $request->title;
        $keywords = $request->keywords;
        $institute = $request->institute;
        if($institute == 'other'){
            $institute = $request->otherInstitute;
        }

        $exam = $request->exam;
        if($exam == 'other'){
            $exam = $request->otherExam;
        }
        //Give Option for Other
        $level = $request->level;
        $duration = $request->duration;
        $published = 0;
        $promotion = 0;
        $public = 0;  
        if($request->public == 1){
            $public = 1;
            if($request->promotion == 1){
                $promotion = 1;
            }  
        }
        //Create Test Link
        $objectivetest =  Objectivetest::create([
            'user_id' =>  auth()->user()->id,
            'title' => $request->title,
            'keywords' => $request->keywords,
            'institute' => $request->institute,
            'exam' => $exam,
            'level' => $level,
            'duration' => $duration,
            'public' => $public,
            'published' => $published,
            'promotion' => $promotion,
        ]);
        //Database entry for all Shared Status of the TEST        
            foreach ($request->shareWith as $shareWith){
                $relation = SchoolTeacherRelation::find($shareWith);
                $testshared = Testshared::create([
                'objectivetest_id' => $objectivetest->id,
                'school_id' => $relation->school_id,
                'sclass_id' => $relation->sclass_id,
                'section_id' => $relation->section_id,
                ]);
            } 
        

        //DATABASE Entry Point For all subject and respective Questions
        for ($i=0; $i <7 ; $i++) { 
            if($request->has('subject'.$i)){
                if($request->post('subject'.$i) == 0){
                    //Other Subject has been Selected Take the name of Other Subject;
                   $subjectName = $request->post('otherSubject'.$i);
                   $NoOfQuestions = $request->post('subject'.$i.'question');              
                }
                else{
                   $subject = Subject::find($request->post('subject'.$i)); 
                   $subjectName = $subject->name;
                   $NoOfQuestions = $request->post('subject'.$i.'question');
                }
                //Insert in Database
                //Create Database Entry Code Below
                $testquestion =  Testquestion::create([
                'objectivetest_id' =>  $objectivetest->id,
                'subject' =>  $subjectName,            
                'noOfQuestions' => $NoOfQuestions,
                ]);
            }
        }
///CHANGE THIS ROUTE FOR WORKING PROPERLy
        return view('test.singleTest')->with('test', $objectivetest);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($userid)
    {
       // $user_id = $id;
       // dd($userid);

        $tests = Objectivetest::where('user_id','=',$userid)->get();
        //dd($tests);

        return view('test.testlist')->with('tests', $tests);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        //dd(json_decode($request->practice));
        //$subject = 'English';
       // $test_id = 1;
        $sessionKey = $id;

        //dd($sessionKey);

       // $sessionKey = auth()->user()->id.'_'.$request->subject.'_'.$test_id;
        //$sessionKey = 'questions';
        //Session::put($sessionKey, $questions);

        $break = explode("_",$sessionKey);
        $test_id = $break[2];
        $subject = $break[1];
        dd($subject);

        Session::put($sessionKey, $request->practice);
        dd(Session::get($sessionKey));

        //explode(" ",$str);

        $request->session();
        //$questions = "[1, 2 ,3]";
      //  Session::put('questions', $questions);
        return view('test.test');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function singleTest($id)
    {
        $objectivetest =  Objectivetest::find($id);
        $htmltext = ''; 

        foreach($objectivetest->testquestions as $question){
            $a = json_decode($question->question);
            $a = count($a);
            $b = route('add.question', $question->id);
        // $htmltext = $htmltext.$question->subject.'->'.$question->noOfQuestions.'Ques of which '.$a.' uploaded <a href='.$b."class='btn btn-success btn-sm ml-2'>Add Que</a> <a href=".$b." class='btn btn-warning btn-sm'>View Que</a> <br>";
            $htmltext = "<p>HI I AM RAHUl</p>";

        }
        //dd($htmltext);      
        return view('test.singleTest')->with('test', $objectivetest)->with('htmltext', $htmltext);
    }

    public function addQuestion($id)
    {
        $testquestion =  Testquestion::find($id);
               // dd($testquestion);
        //$questionArray = $testquestion->question;
        $questionArray = json_decode($testquestion->question);
       // dd($questionArray);

        $test = $testquestion->objectivetest;
        return view('test.addQuestion')->with('testquestion', $testquestion)->with('test', $test)->with('questionArray', $questionArray);
    }

    public function updateQuestions(Request $request, $id){

        $que_id = $request->que_id;
        $message = $request->message; //'insert';
        $testquestion =  Testquestion::find($id);
        $question = json_decode($testquestion->question);
        // $practicequestions = PracticeQuestion::whereIn('id',$question)->get();
        // dd($practicequestions);
        if(!isset($question)){
            $question = [];
        }
        if ($message=='insert' && !in_array($que_id, $question)){
            array_push($question,  $que_id);
            $testquestion->update(['question' => $question]);
        }
        elseif($message=='delete' && in_array($que_id, $question)){
            $arrayQue_id = [$que_id];
            $result=array_diff($question, $arrayQue_id);
            $reIndexArray = array_values( $result);
            $testquestion->update(['question' =>  $reIndexArray]);
        }  
        return response()->json(["success" => 'success']);
        //array_push($question,  $que_id);
    }

    public function addedQuestions($id)
    {
        $testquestion =  Testquestion::find($id);
               // dd($testquestion);
        $question = json_decode($testquestion->question);
        $practicequestions = PracticeQuestion::whereIn('id',$question)->get();
        dd($practicequestions);

        //$test = $testquestion->objectivetest;
        return view('test.addedQuestions')->with('practicequestions', $practicequestions);
    }

    public function testTakers($id)
    {
        $objectivetest =  Objectivetest::find($id);

        
               
               // dd($testquestion);
        // $question = json_decode($testquestion->question);
        // $practicequestions = PracticeQuestion::whereIn('id',$question)->get();
        // dd($practicequestions);

        //$test = $testquestion->objectivetest;
       return view('test.startTest')->with('objectivetest', $objectivetest);

            //Below Test has the paper Draft///
     // return view('test.testTaker')->with('objectivetest', $objectivetest);
    }

    public function evaluateResult()
    {
        function array_push_assoc($array, $key, $value){
           $array[$key] = $value;
           return $array;
        }
        $testquestion =  Testquestion::find(31);
      //  dd($testquestion->question);
        $correctanswer = [];
        foreach (json_decode($testquestion->question) as $question) {
            $practicequestion = PracticeQuestion::where('id',$question)->first();
            $answer = $practicequestion->answer->correct_option;
           // dd($practicequestion);
            $correctanswer = array_push_assoc($correctanswer, $question, $answer);
        }
       // dd($correctanswer);
        $answered = ["14"=>"A", "15"=>"C", "16"=>"D"];
      //  $correctanswer = ["1"=>"B", "2"=>"A", "3"=>"D", "4"=>"D"];
        $right = 0;
        $wrong = 0;
        $notanswered = 0;
        foreach ($correctanswer as $key => $value) {
            if(isset($answered[$key])){
                if($answered[$key] == $correctanswer[$key]){
                  //  "answered Correctly";
                     $right =  $right + 1;
                }
                else{
                   // "answered incorrect";
                    $wrong = $wrong + 1;
                }
            }
            else{
                $notanswered = $notanswered + 1;
               // "Not answered";
            }
        }
        dd('Right = '.$right.' Wrong = '.$wrong.' NotAnswered = '.$notanswered);
    }

    public function submitAnswer(Request $request)
    {
        $answers = $request->answer;
       // dd($answers);
         $testquestion =  Testquestion::find(28);


        $questions = [
        "English" => ["11", "12", "13"],
        "Maths" => ["14", "15", "16"],
        "GK" => ["17", "18", "19"],
        "Reasoning" => ["20", "21", "22"]
        ];

        $answered = [
        "English" => ["11"=>"B", "12"=>"B", "13"=>"B"],
        "Maths" => ["14"=>"B", "15"=>"B", "16"=>"B"],
        "GK" => ["17"=>"B", "18"=>"B", "19"=>"B"],
        "Reasoning" => ["20"=>"B", "21"=>"B", "22"=>"B"]
        ];
dd($answers);
        // $a = json_decode($testquestion->question);
        // dd($a[]);
              //  $answered = ["141002"=>"A", "15"=>"C", "16"=>"D"];
                dd((unserialize(serialize($answered['GK']))));


//dd(json_decode(json_encode($answered))->16);

        $testquestion->update([
            'question'=>serialize($answered),
        ]);
        
        //);
        //$array = $request->array;




        dd($answers);
    }
}
