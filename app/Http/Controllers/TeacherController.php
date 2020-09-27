<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\School; 
use App\Teacher;
use App\User;
use App\Sclass;
use App\Student;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //$teacher = auth()->user()->teacher;
        $teachers = Teacher::all();
        //dd($teachers);

        return view('admin.teacherView')->with('teachers', $teachers);
        //dd('teacher');
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
        // $qualification =  $request->qualification;
        // $school = $request->school;
        // $user_id = auth()->user()->id;
        // $class_id = $request->classId;
        // $school_id = $request->schoolId;

        // $teacher = Teacher::create([
        // 'DOB'=>$DOB,
        // 'contactNo'=>$contactNo,
        // 'qualification'=>$qualification,
        // 'class_id'=>$class_id,
        // 'school_id'=>$school_id,
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
    public function edit(Teacher $teacher)
    {
        $schools = School::all();
        $classes = Sclass::all();

        return view('teacher.edit')->with('teacher', $teacher)->with('schools', $schools)->with('classes', $classes);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
       // $user_id = auth()->user()->id;
       //  $data = $request->only(['class', 'qualification', 'school', 'contact', 'id', 'name', 'DOB']);
       //  $teacher->update($data);
       //  return redirect(route('home')); 
        //dd($request->classes);
        //$i = '';
       // dd($teacher->id);
        if(isset($request->classes)){
            DB::table('sclass_teacher')->where('teacher_id', '=', $teacher->id)->delete();

            foreach ($request->classes as $class) {
            //$i = $i.$class; 
            //Delete all old enteries 
                DB::table('sclass_teacher')->insert([
                    'sclass_id' => $class, 
                    'teacher_id' => $teacher->id
                ]);
            }
        }
        //dd($i);

        //dd($request->contactNo);
        $DOB = $request->DOB;
        $contactNo = $request->contactNo;
        $qualification =  $request->qualification;
        $school = $request->school;
        $user_id = auth()->user()->id;
        $class_id = $request->classId;
        $school_id = $request->schoolId;
        $approved = $request->approved;

        $teacher->update([
        'DOB'=>$DOB,
        'contactNo'=>$contactNo,
        'qualification'=>$qualification,
        //'sclass_id'=>$class_id,
        'school_id'=>$school_id,
        'user_id'=>$user_id,
        'approved'=>$approved,
        ]);
        if(isset($request->img)){
             $profileimageUrl = ($request->img->store('user_'.$user_id.'/profileimage'));
             User::find($user_id)->update([
            'img' => $profileimageUrl,
            ]);          
        }

        $aboutme = auth()->user()->teacher;

        return view('/home')->with('aboutme', $aboutme);

  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect(route('home'));
    }

    public function myClass(Request $request, Sclass $sclass){
        //This function will retrive the name of all the students of a my class. 
       $school_id = auth()->user()->teacher->school_id;
       $students = Student::where([['school_id', '=', $school_id], ['sclass_id', '=', $sclass->id]])->get();
        return view('teacher.myClass')->with('students', $students)->with('sclass', $sclass);
    }


}
