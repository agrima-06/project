<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sclass;
use App\Section; 
use App\Student; 

use App\SchoolTeacherRelation;
use DB;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $classes = Sclass::all();
            //$sections = Section::all();
            return view('admin.addClass')->with('classes', $classes);
        }
        //route list kholo
        if (auth()->user()->role == 'schoolstaff') {
           $school_id = auth()->user()->schoolstaff->school->id;

           $relations = SchoolTeacherRelation::select('school_id','sclass_id', 'section_id')->where('school_id', '=', $school_id)->distinct()->orderby('sclass_id')->get();

           // $relations = SchoolTeacherRelation::select('sclass_id', 'section_id')->where('school_id', '=', $school_id)->distinct()->orderby('sclass_id')->get('id', 'sclass_id', 'section_id');

        // $relations = SchoolTeacherRelation::distinct('sclass_id', 'section_id')->get();
        // dd($relations);


           return view('class.schoolClassesList')->with('relations', $relations);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('class.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $class = ($request->class);
        $approved = 0;

        if (auth()->user()->role == 'admin') {
            $approved = 1;
        }
       // $school_id =  $request->school_id;

        Sclass::create([
        'class'=>$class,
        'approved'=>$approved,
        ]);
        return redirect(route('class.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Sclass $class)
    {
      return view('schoolstaff.classView')->with('class', $class);
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd('hehe');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Sclass $class)
    {
      //  dd($class);
        $class->update(['approved' => 1]);  
        return redirect(route('class.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sclass $class)
    {
        $class->delete();
        return redirect(route('class.index'));
    }

    public function schoolClassProfile($sId, $cId, $secId)
    {
      $school_id = $sId; 
      $sclass_id = $cId;
      $section_id = $secId;
      $relations = SchoolTeacherRelation::where([['school_id', '=', $school_id], ['sclass_id', '=', $sclass_id], ['section_id', '=', $section_id]])->get();
      $students = Student::where([['school_id', '=', $school_id], ['sclass_id', '=', $sclass_id], ['section_id', '=', $section_id]])->get();

      return view('class.schoolClassProfile')->with('relations', $relations)->with('students', $students);

    }
}
