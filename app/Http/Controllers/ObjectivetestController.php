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
use App\Testresult;

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

    public function evaluateResult($testresult_id)
    {
        //THIS WILL BE THE RESULT....
        $testresult =  Testresult::find($testresult_id);
        $objectivetest = $testresult->objectivetest;
        $answered = unserialize($testresult->answer);
        $subResult31 = [
            "subjectName" => "English",
            "right" => '15',
            "wrong" => '10',
            "notanswered" => '12'
        ];
       // dd($subResult31['right']);
        //dd($answered['sub31']['17']);
        //dd($user_answer->testquestions);
       // return $testresult->answer;

        function array_push_assoc($array, $key, $value){
           $array[$key] = $value;
           return $array;
        }
        // $objectivetest = $testresult->objectivetest;
        //dd($objectivetest->testquestions);
               // $correctanswer = [];
        $subjectsWithAnswer=[];
        foreach ($objectivetest->testquestions as $subject) { 
            $currentSubject = $subject->id.'_sub';
            //double dollar sign converts string to an variable
            $$currentSubject =[];
            //dd($currentSubject);
            foreach (json_decode($subject->question) as $question) {
                $practicequestion = PracticeQuestion::where('id',$question)->first();
                $answer = $practicequestion->answer->correct_option;
                // dd($practicequestion);
                $$currentSubject = array_push_assoc($$currentSubject, $question, $answer);
            }
           // $subjectsWithAnswer = array_push_assoc($subjectsWithAnswer, 
            array_push($subjectsWithAnswer, $currentSubject);
            //dd($$currentSubject);
        }
          //  dd($subjectsWithAnswer[0]);
            $correct = 0;
            $wrong = 0;
            $notanswered = 0;
            $marks = 0;
            //This vairable will contain array with Id, Subject Name, Correct, Incorrect, Not Answered.
            //$result_$subjectWithAnswer = 

            function subject_name_id($id_sub){
                //This function will find the Id and name from the given data
                $stringBreak = explode('_', $id_sub);
                $testquestion = Testquestion::find($stringBreak[0]);
                return $testquestion;
            }

            //subject_name_id('31_sub');
            //This will store the name of all the subjects with results.
            $fullResult = [];
            foreach ($subjectsWithAnswer as $subjectWithAnswer) {
                $correct = 0;
                $wrong = 0;
                $notanswered = 0;
                //dd($answered[$subjectWithAnswer]);
                //dd($$sub);
                $resultArray = 'result_'.$subjectWithAnswer;
                $$resultArray = [];
                $subjectDetails = subject_name_id($subjectWithAnswer);
                //dd($subjectDetails);
                foreach ($$subjectWithAnswer as $key => $value) {
                  //  dd($answered[$subjectWithAnswer][$key]);
                    if(isset($answered[$subjectWithAnswer][$key])){
                        if($answered[$subjectWithAnswer][$key] == $$subjectWithAnswer[$key]){
                          //  "answered Correctly";
                             $correct =  $correct + 1;
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

                $marks = ($subjectDetails->marks * $correct) - ($subjectDetails->negativeMarks * $wrong);
                //This will store id,name,correct,wrong,unaswered, marks in result array
                $$resultArray =  array_push_assoc($$resultArray, 'id', $subjectDetails->id);
                $$resultArray =  array_push_assoc($$resultArray, 'subject', $subjectDetails->subject);
                $$resultArray =  array_push_assoc($$resultArray, 'correct', $correct);
                $$resultArray =  array_push_assoc($$resultArray, 'wrong', $wrong);
                $$resultArray =  array_push_assoc($$resultArray, 'notanswered', $notanswered);
                $$resultArray =  array_push_assoc($$resultArray, 'marks', $marks);
            //Now Start Matching Subjectwise answers..
                array_push($fullResult, $$resultArray);
            }
          //  dd($fullResult);

            return $fullResult;
          


          //  dd('Right = '.$correct.' Wrong = '.$wrong.' NotAnswered = '.$notanswered);


      //     $testquestion =  Testquestion::find(31);
      //   //  dd($testquestion->question);
      //   $correctanswer = [];
      //   foreach (json_decode($testquestion->question) as $question) {
      //       $practicequestion = PracticeQuestion::where('id',$question)->first();
      //       $answer = $practicequestion->answer->correct_option;
      //      // dd($practicequestion);
      //       $correctanswer = array_push_assoc($correctanswer, $question, $answer);
      //   }
      //  // dd($correctanswer);
      //   $answered = ["14"=>"A", "15"=>"C", "16"=>"D"];
      // //  $correctanswer = ["1"=>"B", "2"=>"A", "3"=>"D", "4"=>"D"];
      //   $right = 0;
      //   $wrong = 0;
      //   $notanswered = 0;

      //   foreach ($correctanswer as $key => $value) {
      //       if(isset($answered[$key])){
      //           if($answered[$key] == $correctanswer[$key]){
      //             //  "answered Correctly";
      //                $right =  $right + 1;
      //           }
      //           else{
      //              // "answered incorrect";
      //               $wrong = $wrong + 1;
      //           }
      //       }
      //       else{
      //           $notanswered = $notanswered + 1;
      //          // "Not answered";
      //       }
      //   }
      //   dd('Right = '.$right.' Wrong = '.$wrong.' NotAnswered = '.$notanswered);
    }

    public function submitAnswer(Request $request)
    {        
        $answers = serialize($request->answer);
        $user_id = $request->user_id;
        $test_id = $request->test_id;
    //    dd($answers);
      //  $testquestion = Testquestion::find(28);
        //Check if user has already given Exam
        //$Testresult =  Testresult::where([['user_id', '=', $user_id], ['objectivetest_id', '=', $test_id]])->get();      
        //dd($Testresult);
        $Testresult =  Testresult::create([
            'user_id' => $user_id,
            'objectivetest_id' =>  $test_id,
            'answer' =>  $answers,            
        ]);

         //$fullResult = $this->evaluateResult($Testresult->id);
         $fullResult = $this->evaluateResult($Testresult->id);
         
         $score = 0;
         foreach ($fullResult as $result) {
             $score = $score + $result['marks'];
         }
         $mode = 'ofline';
         //Check if the exam is in Live or Ofline Mode
         //If in Live mode store the max in ofline as well as ofline score will be used to find the Rank and Online Rank will be store defaultly
         if($mode == 'live'){
           // $liveScore =$x;
            $Testresult->update([
            'liveScore' => $score,
            'oflineScore' =>  $score,
            ]);
         }
         else{
            $Testresult->update([
            'oflineScore' =>  $score,
            ]);
         }
           // $oflineScore = $x; 

         //Calculate the Rank
        function calculateRank($results, $user_id){
            $count = 0;
            foreach ($results as $rank) {
              $count = $count + 1;
              if ($rank->user_id == $user_id) {
                break;
              }
            }
            return $count;
        }
       // dd($test_id);
        $results = Testresult::where('objectivetest_id', $test_id)->orderBy('oflineScore', 'desc')->get();
       // dd($results);
        $rank = calculateRank($results, $user_id);

        //Top 200 Ranks
        $topresults = Testresult::where('objectivetest_id', $test_id)->orderBy('oflineScore', 'desc')->take(200)->get();

        //dd($topresults);
        //orderBy(..)->take(5)->get()

        
        return view('test')->with('fullResult', $fullResult)->with('rank', $rank)->with('topresults', $topresults);

        dd(unserialize($Testresult->answer));

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

    public function deletethisfunction()
    {
        $testquestion =  Testquestion::find(16);
        $question = json_decode($testquestion->question);
        $practicequestions = PracticeQuestion::whereIn('id',$question[1])->get();

        dd(json_decode($practicequestions));
    }
}
