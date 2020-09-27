<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
 
use App\Student;
use App\User;
use App\School;
use App\Sclass;
use App\Subject;
use App\Teacher;
use App\SchoolTeacherRelation;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (auth()->user()->role == 'schoolstaff') {

          // $schools = School::all();
          // $practiceQuestions = PracticeQuestion::all();
          // $homeworks = Homework::all();
          // $teachers = Teacher::all();
          // $students = Student::all();

            // return view('schoolstaff.home')->with('schools', $schools)->with('teachers', $teachers)->with('students', $students)->with('homeworks', $homeworks)->with('practiceQuestions', $practiceQuestions);  
            return view('schoolstaff.home');//->with('aboutme', $aboutme);
        }

        elseif (auth()->user()->role == 'student') {
        
          $student = auth()->user()->student;

           return view('student.view')->with('student', $student);
          
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $DOB = $request->DOB;
        // $contactNo = $request->contact;
        // $school = $request->school;
        // $user_id = auth()->user()->id;
        // $class_id = $request->classId;
        // $school_id = $request->schoolId;

        // $student = Student::create([
        // 'DOB'=>$DOB,
        // 'contactNo'=>$contactNo,
        // //'school_id'=>$school_id,
        // 'user_id'=>$user_id,
        // ]);
  
        // return "your profile is now completed";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        dd(auth()->user()->id);    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $schools = School::all();
        $classes = Sclass::all();
         return view('student.edit')->with('student', $student)
                                    ->with('schools', $schools)
                                    ->with('classes', $classes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
       // $user_id = auth()->user()->id;


       // dd($profileimageUrl);

        $DOB = $request->DOB;
        //$img = $request->img;
        $contactNo = $request->contactNo;
        $school = $request->school;
        $user_id = auth()->user()->id;
        $class_id = $request->classId;
        $school_id = $request->schoolId;
        $approved = $request->approved;
         //dd($contactNo);

        $student->update([
        'DOB'=>$DOB,
       // 'img'=>$img,
        'contactNo'=>$contactNo,
        'school_id'=>$school_id,
        'sclass_id' => $class_id,
        'user_id'=>$user_id,
        'approved'=>$approved,
        ]);

       if(isset($request->img)){
             $profileimageUrl = ($request->img->store('user_'.$user_id.'/profileimage'));
             User::find($user_id)->update([
            'img' => $profileimageUrl,
            ]);          
        }


        return redirect(route('home')); 
    }

    /**
     * Remove the specified resource from storage. 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect(route('home'));
    }

     public function myClass(Request $request, Subject $subject){
        //This function will retrive the name of all the students of a my class. 
        $school_id = auth()->user()->student->school_id;
        $sclass_id = auth()->user()->student->sclass->id;
        //dd($sclass_id);
        $subject_id = $subject->id;        
        //$teacher = Teacher::find(1);
        $teachers = SchoolTeacherRelation::where([['school_id', '=', $school_id], ['sclass_id', '=', $sclass_id], ['subject_id', '=', $subject_id]])->get();
        //dd($teachers);

        //dd($teachers[0]->teacher->user->name);


        return view('student.myTeacher')->with('teachers', $teachers)->with('subject', $subject);
    }

}
