<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Submit;
use App\Homework;
use DB;

class SubmitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$submitHws = Submit::all();
        //return view('submitHw.view')->with('submitHws', $submitHws);
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
        $student_id = ($request->student_id);
        $homework_id = ($request->homework_id); 
        //dd($submitHw);

        Submit::create([
        'homework_id'=>$homework_id,
        'student_id'=>$student_id,
        ]);

        $submitHw = ($request->submitHw);
            $url = ($submitHw->store('user_'.$user_id.'/submitHomework/hw_'.$homework->id));

             $submits = Submit::create([
                'url'=>$url,
                'homework_id'=>$homework->id,       

        ]);

        return "jkjk";
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
    public function update(Request $request, $id)
    {
        //
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
}
