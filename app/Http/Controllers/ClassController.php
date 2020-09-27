<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sclass;
use App\Section; 
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
        $classes = Sclass::all();
        //$sections = Section::all();
        return view('admin.addClass')->with('classes', $classes);
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
}
