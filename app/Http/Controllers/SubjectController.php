<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\SchoolTeacherRelation;

use DB;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {            
        if (auth()->user()->role == 'schoolstaff') {
          $school_id = auth()->user()->schoolstaff->school->id;
          $relations = SchoolTeacherRelation::select('subject_id', 'school_id')->where([['school_id', '=', $school_id]])->distinct()->get();
          $newrelations = SchoolTeacherRelation::select('subject_id', 'school_id', 'teacher_id')->where([['school_id', '=', $school_id]])->distinct()->get();
          $newClassrelations = SchoolTeacherRelation::select('subject_id', 'school_id', 'sclass_id', 'section_id')->where([['school_id', '=', $school_id]])->distinct()->get();
           return view('schoolstaff.subject')->with('relations', $relations)->with('newrelations',$newrelations)->with('newClassrelations', $newClassrelations);
        }

        // $subjects = Subject::all();
        // return view('subject.view')->with('subjects', $subjects);
    }

    /** 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subject.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subject = ucfirst($request->subject); 
        $approved = 0;

        if (auth()->user()->role == 'admin') {
            $approved = 1;
        }

        Subject::create([
        'name'=>$subject, 
        'approved'=>$approved,

        // 'school_id'=>$school_id,

        ]);

        return redirect(route('subject.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request,Subject $subject)
    {
        $subject->update(['approved' => 1]);  
        return redirect(route('subject.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect(route('subject.index'));
    }
}
