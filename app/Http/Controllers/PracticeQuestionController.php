<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PracticeQuestion;
use App\PracticeAnswer;
use App\Subject;
use App\Sclass;
use App\DB;
use App\Topic;
use App\SchoolTeacherRelation;

class PracticeQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$array = array("Volvo", "BMW", "Toyota");
        $array = [11, 12, 14];
        $practicequestions = PracticeQuestion::whereIn('id',$array)->get();


        dd($practicequestions);

        if(auth()->user()->role == 'teacher'){

          $teacher_id = auth()->user()->teacher->id;          
          $relations = SchoolTeacherRelation::select('sclass_id', 'teacher_id')->where('teacher_id', '=', $teacher_id)->distinct()->get();
           $topics = null;
           $edit = null;
           $practicequestions = null;           
           $sclass = null;
           $subject = null;
           $action = null;

          if($request->class_id && $request->subject && $request->action){
     
            $sclass = Sclass::find($request->class_id);
           
            $subject = Subject::where('name', $request->subject)->first();

            $action = ($request->action);
            if($action ==1 ){
            $topics = Topic::select('topic')->where('subject_id', '=', $subject->id)->distinct()->get();
            }

            elseif($action == 2){
               $practicequestions = PracticeQuestion::where([['sclass_id', '=', $request->class_id], ['subject_id', '=', $subject->id], ['user_id', '=', auth()->user()->id]])->orderBy('id', 'DESC')->get();
               $edit = 1;
            }

            elseif($action == '3'){
               $practicequestions = PracticeQuestion::where([['sclass_id', '=', $request->class_id], ['subject_id', '=', $subject->id], ['user_id', '!=', auth()->user()->id]])->orderBy('id', 'DESC')->get();
            }             

          } 
            return view('practiceQuestion.viewAll')->with('sclass', $sclass)->with('subject', $subject)->with('action', $action)->with('relations', $relations)->with('topics', $topics)->with('practicequestions',  $practicequestions)->with('edit', $edit);      
        }

        elseif(auth()->user()->role == 'student'){
            $practiceQuestions = PracticeQuestion::all();
            return view('practiceQuestion.viewAll')->with('practiceQuestions', $practiceQuestions);
        }
        elseif(auth()->user()->role == 'admin'){
            $practiceQuestions = PracticeQuestion::all();
            return view('practiceQuestion.admin')->with('practiceQuestions', $practiceQuestions);   
        }
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('practiceQuestion.form');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = auth()->user()->id;
        $question = ($request->question);
        $sclass_id = ($request->class_id);
        $subject_id = ($request->subject_id);
        //$topic = ($request->topic);
        $subtopic_id = ($request->subtopic_id);
        //Sub Topic Id is actually a Topic Id. 
        $Level = ($request->Level);
        $optionA = ($request->optionA);
        $optionB = ($request->optionB);
        $optionC = ($request->optionC);
        $optionD = ($request->optionD);
        $optionE = ($request->optionE);
        $correct_option = ($request->correct_option);
        $hint = ($request->hint);
        $explanation = ($request->explanation);
        $file_url = ($request->file_url);


        $practiceAnswer = PracticeAnswer::create([
        'optionA'=>$optionA,
        'optionB'=>$optionB,
        'optionC'=>$optionC,
        'optionD'=>$optionD,
        'optionE'=>$optionE,
        'correct_option'=>$correct_option,
        'hint'=>$hint,
        'explanation'=>$explanation,
         ]);

        $practiceQuestion = PracticeQuestion::create([
        'user_id'=>$user_id,
        'question' =>$question,
        'sclass_id' =>$sclass_id,
        'subject_id'=>$subject_id,
        'answer_id'=>$practiceAnswer->id,
        'topic_id'=>$subtopic_id,
        'Level'=>$Level,
        'file_url'=>$file_url,
        ]);
        if(isset($request->file_url)){
            $file_url = $request->file_url;
            $url = ($file_url->store('user_'.$user_id.'/practiceQuestion/pq_'.$practiceQuestion->id));

             $practiceQuestionfile = PracticeQuestionfile::create([
                'url'=>$url,
                'practiceQuestion_id'=>$practiceQuestion->id,
            ]);
        }
        
        //dd($practiceQuestion);
        return redirect(route('practiceQuestion.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PracticeQuestion $practiceQuestions)
    {
      return view('practiceQuestion.viewAll')->with('practiceQuestions', $practiceQuestions);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PracticeQuestion $practiceQuestion)
    {
        $teacher_id = auth()->user()->teacher->id;          
    
        $subject = $practiceQuestion->subject;
        $topics = Topic::select('topic')->where('subject_id', '=', $subject->id)->distinct()->get();
   
        $subtopics = Topic::where('topic', '=' ,$practiceQuestion->topic->topic)->get();

        $relations = SchoolTeacherRelation::select('sclass_id', 'teacher_id')->where('teacher_id', '=', $teacher_id)->distinct()->get();

        $class_id = $practiceQuestion->sclass_id;           
       // $sclass = Sclass::where('class', '=', $class)->get();
        $SchoolTeacherRelations = SchoolTeacherRelation::where([['sclass_id', '=', $class_id], ['teacher_id', '=', $teacher_id]])->get();
       // dd($SchoolTeacherRelations->subject)
        $subjects = [];

        foreach ($SchoolTeacherRelations as $relation) {
                   
            if(!in_array($relation->subject->name, $subjects, TRUE))
            array_push($subjects, $relation->subject->name);            
        }  

       return view('practiceQuestion.edit')->with('practiceQuestion', $practiceQuestion)->with('topics', $topics)->with('subtopics', $subtopics)->with('subjects', $subjects)->with('relations', $relations);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PracticeQuestion $practiceQuestion)
    {

       // dd($practiceQuestion);

       // $user_id = auth()->user()->id;
        $question = ($request->question);
        $sclass_id = ($request->class_id);
        //dd($sclass_id);
        //$topic = ($request->topic);
        $subject = Subject::where('name', $request->get('subject'))->first();
                    //dd($request->get('subject'));
        $subject_id = ($subject->id);

        $subtopic_id = ($request->subtopic_id);

      //  dd($subtopic_id);
        //Sub Topic Id is actually a Topic Id. 
        $Level = ($request->Level);

       // dd($Level);
        $optionA = ($request->optionA);
        $optionB = ($request->optionB);
        $optionC = ($request->optionC);
        $optionD = ($request->optionD);
        $optionE = ($request->optionE);
        $correct_option = ($request->correct_option);
        $hint = ($request->hint);
        $explanation = ($request->explanation);
        $file_url = ($request->file_url);
        //dd($hint);

        
       // dd($practiceQuestion->answer->id);
        $practiceAnswer =  PracticeAnswer::find($practiceQuestion->answer->id);

        $practiceAnswer->update([
        'optionA'=>$optionA,
        'optionB'=>$optionB,
        'optionC'=>$optionC,
        'optionD'=>$optionD,
        'optionE'=>$optionE,
        'correct_option'=>$correct_option,
        'hint'=>$hint,
        'explanation'=>$explanation,
        ]);



        // $practiceAnswer = PracticeAnswer::create([
        // 'optionA'=>$optionA,
        // 'optionB'=>$optionB,
        // 'optionC'=>$optionC,
        // 'optionD'=>$optionD,
        // 'optionE'=>$optionE,
        // 'correct_option'=>$correct_option,
        // 'hint'=>$hint,
        // 'explanation'=>$explanation,
        //  ]);

        // $practiceQuestion = PracticeQuestion::create([
        // 'user_id'=>$user_id,
        // 'question' =>$question,
        // 'sclass_id' =>$sclass_id,
        // 'subject_id'=>$subject_id,
        // 'answer_id'=>$practiceAnswer->id,
        // 'topic_id'=>$subtopic_id,
        // 'Level'=>$Level,
        // 'file_url'=>$file_url,
        // ]);

        $practiceQuestion->update([
        'question' =>$question,
        'sclass_id' =>$sclass_id,
        'subject_id'=>$subject_id,
        //'answer_id'=>$practiceAnswer->id,
        'topic_id'=>$subtopic_id,
        'Level'=>$Level,
        'file_url'=>$file_url,
        ]);


        dd('Done');

        if(isset($request->file_url)){
            $file_url = $request->file_url;
            $url = ($file_url->store('user_'.$user_id.'/practiceQuestion/pq_'.$practiceQuestion->id));

             $practiceQuestionfile = PracticeQuestionfile::create([
                'url'=>$url,
                'practiceQuestion_id'=>$practiceQuestion->id,
            ]);
        }
        
        //dd($practiceQuestion);
        return redirect(route('practiceQuestion.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PracticeQuestion $practiceQuestion)
    {
        $practiceQuestion->delete();
        return redirect('/practiceQuestion');
    }
    public function studentPracticeQuestion(Subject $subject){
        //$school_id = auth()->user()->student->school_id;
       
        $sclass_id = auth()->user()->student->sclass_id;
        $practiceQuestions = PracticeQuestion::where([['sclass_id', '=', $sclass_id], ['subject_id', '=', $subject->id]])->get();
        $topic_ids = PracticeQuestion::select('topic_id')->where([['sclass_id', '=', $sclass_id], ['subject_id', '=', $subject->id]])->distinct()->get();
 // $subtopics = Topic::select('topic', 'sub_topic')->where([['sclass_id', '=', $sclass_id], ['subject_id', '=', $subject->id]])->distinct()->get();

        //dd($topics[0]->topic);
        
        $topics = [];

        foreach ($topic_ids as $topic_id) {          
           //$topic->topic->topic; 
            if(!in_array($topic_id->topic->topic, $topics, TRUE))
            {
              array_push($topics, $topic_id->topic->topic); 
            }      
        }

    $subtopics = $topic_ids; //From topic_id subtopics can be derived in blade. 

    return view('practiceQuestion.viewAll')->with('practiceQuestions', $practiceQuestions)->with('topics', $topics)->with('subtopics', $subtopics);      
     
     }

    public function sortQuestion($topic_id, $sub_topic)
    {
        
        $sclass_id = auth()->user()->student->sclass_id;
        $practicequestions = PracticeQuestion::where([['topic_id', '=', $topic_id], ['sclass_id', '=', $sclass_id]])->paginate(10);

        //dd($practicequestions);

        return view('practiceQuestion.view', compact('practicequestions'));
    }

    public function ajaxSubject(Request $request)
    {
        //This function is for AJAX for taking Subject as per the Class
        $teacher_id =  auth()->user()->teacher->id;
       // $relations = auth()->user()->teacher->schoolTeacherRelations;
        $class_id = $request->get('class_id');           
       // $sclass = Sclass::where('class', '=', $class)->get();
        $SchoolTeacherRelations = SchoolTeacherRelation::where([['sclass_id', '=', $class_id], ['teacher_id', '=', $teacher_id]])->get();
       // dd($SchoolTeacherRelations->subject)
        $subjects = [];

        foreach ($SchoolTeacherRelations as $relation) {
           //$class->schoolTeacherRelations
            //$relation->subject->name;              
            if(!in_array($relation->subject->name, $subjects, TRUE))
            array_push($subjects, $relation->subject->name);            
        }  
        return response()->json(["data" => $subjects]);
    }


    public function ajaxTopic(Request $request)
    {

        $subject = Subject::where('name', $request->subject)->first();
        $topics = Topic::select('topic')->where('subject_id', '=', $subject->id)->distinct()->get();

        return response()->json(["topics" => $topics]);
    }


    public function ajaxSubtopic(Request $request)
    {
        //This function is for AJAX for taking Subject as per the Class
       // $teacher_id =  auth()->user()->teacher->id;
       // $relations = auth()->user()->teacher->schoolTeacherRelations;
        $topic = $request->get('topic');

        if($request->get('subject_id')){
            //This Relation is for the Add Question 
            $subject_id = $request->get('subject_id');
            $Subtopics = Topic::where([['topic', '=', $topic], ['subject_id', '=', $subject_id]])->get();
        }

        elseif ($request->get('subject')) {
            //This Relation is for the Edit Question Mode.
            //$subject = $request->get('subject');
            $subject = Subject::where('name', $request->get('subject'))->first();
            $Subtopics = Topic::where([['topic', '=', $topic], ['subject_id', '=', $subject->id]])->get();

        }
        return response()->json(["subtopics" => $Subtopics]);
    }

}
