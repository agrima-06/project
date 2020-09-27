<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Homework;
use App\User;
use Illuminate\Support\Facades\Storage;
use App\School;
use App\Sclass;
use App\Subject;
use App\Homeworkfile;
use DB;

class HomeworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $classes = Sclass::all();
        if(auth()->user()->role == 'teacher')
        {
        $homeworks = User::find(auth()->user()->id)->homeworks;
        //dd($homeworks);
        return view('homework')->with('homeworks', $homeworks);
        }
        if(auth()->user()->role == 'admin')
        {
        $homeworks = Homework::all();
        return view('admin.homeworkView')->with('homeworks', $homeworks);
        }
        elseif(auth()->user()->role == 'student'){
           // dd(auth()->user()->student->sclass_id);
           $school_id = auth()->user()->student->school_id;
           $sclass_id = auth()->user()->student->sclass_id;
           // $homeworks = DB::table('homework')->where('school_id', '=', $school_id)->get();
          // $homeworks = DB::table('homework')->where([['school_id', '=', $school_id], ['sclass_id', '=', $sclass_id]])->get();
           $homeworks = homework::where([['school_id', '=', $school_id], ['sclass_id', '=', $sclass_id]])->get();

          // dd($homeworks);

            return view('homework.studentView')->with('homeworks', $homeworks)->with('classes', $classes);
        }
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        //dd($request->class[]);
       // dd(auth()->user()->teacher->school->id);
        $topic = ucfirst($request->topic);
        $content = ucfirst($request->content);
        $hint =  ucfirst($request->hint);
        $class = $request->class;
        $user_id = auth()->user()->id;
        $subject_id =  $request->subject;
        $school_id = auth()->user()->teacher->school->id;

        $homework = Homework::create([
        'topic'=>$topic,
        'content'=>$content,
        'hint'=>$hint,
        'sclass_id'=>$class,
        'subject_id'=>$subject_id,
        'user_id'=>$user_id,
        'school_id'=>$school_id,
        ]);
  
        if(isset($request->file)){
            $file = $request->file;
            $url = ($file->store('user_'.$user_id.'/homework/hw_'.$homework->id));

             $homeworkfile = Homeworkfile::create([
                'url'=>$url,
                'homework_id'=>$homework->id,
            ]);
        }

        return redirect(route('home')); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Homework $homework)
    {
        return view('homework.view')->with('homework', $homework);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Homework $homework)
    {
       // dd($homework);
       // $classes = Sclass::all();

       return view('homework.edit')->with('homework', $homework)->with('edit', 'edit');
 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Homework $homework)
    {

        $topic = ucfirst($request->topic);
        $content = ucfirst($request->content);
        $hint =  ucfirst($request->hint);
        $class_id = $request->class;
        $user_id = auth()->user()->id;
        $subject =  ucfirst($request->subject);

        $homework->update([
        'topic'=>$topic,
        'content'=>$content,
        'hint'=>$hint,
        'sclass_id'=>$class_id,
        //'school_id'=>$school_id,
        'user_id'=>$user_id,
        'subject_id'=>$subject,
        ]);

        if ($request->hasFile('file')) {           
           $homeworkfiles = $homework->Homeworkfiles;
            foreach($homeworkfiles as $homeworkfile){
            Storage::delete($homeworkfile->url);
            }
            $url = ($request->file->store('user_'.$user_id.'/homework/hw_'.$homework->id));
                DB::table('homeworkfiles')
              ->where('id', $homework->Homeworkfiles[0]->id)
              ->update(['url' => $url]);
        }

        return redirect(route('home')); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Homework $homework)
    {
        $homework->delete();
        return redirect('/homework');
    }

    public function ajaxSubject(Request $request)
    {

        //This function is for AJAX for taking Subject as per the Class
        $class_id = $request->get('class_id');
        $sclass= Sclass::find($class_id);
        $subjects = $sclass->subjects;

     //   dd($subjects);


       // $homework->delete();
            return response()->json(["data" => $subjects]);

        //return view('/test2')->with('subjects', $subjects);
    }

     public function studentHomework(Subject $subject){
        $school_id = auth()->user()->student->school_id;
        $sclass_id = auth()->user()->student->sclass_id;
        $homeworks = homework::where([['school_id', '=', $school_id], ['sclass_id', '=', $sclass_id], ['subject_id', '=', $subject->id]])->get();
                //dd($homeworks);
        return view('homework.studentView')->with('homeworks', $homeworks);
     }

    public function homeworksubmit(Request $request, Homework $homework){
       
        dd($homework);
        //$school_id = auth()->user()->student->school_id;
        //$sclass_id = auth()->user()->student->sclass_id;
       // $homeworks = homework::where([['school_id', '=', $school_id], ['sclass_id', '=', $sclass_id], ['subject_id', '=', $subject->id]])->get();
                //dd($homeworks);
        return view('homework.studentView')->with('homeworks', $homeworks);
     }

}
