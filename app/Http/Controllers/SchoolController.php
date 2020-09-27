<?php

namespace App\Http\Controllers;
use App\School;
use DB;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = School::all();
        //dd();
        return view('school.view')->with('schools', $schools);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('school.create');
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required|min:5',
            // 'city' => 'required',
            // 'state' => 'required',
            // 'address' => 'required',
            // 'affilated_to' => 'required',
        ]);

        $name = ucfirst($request->name);
        $country = ucfirst($request->country);
        $state =  ucfirst($request->state);
        $city = ucfirst($request->city);
        $address = $request->address;
        $affilated_to = $request->affilated_to;
        $user_id = auth()->user()->id;
        $status = 0;

        if (auth()->user()->role == 'admin') {
            $status = 1;
        }

       // dd($status);

        School::create([
        'name'=>$name, 
        'country'=>$country,       
        'state'=>$state,
        'city'=>$city,
        'address'=>$address,
        'affilated_to'=>$affilated_to,
        'user_id'=>$user_id,
        'approved'=>$status,
        ]);

        return redirect(route('school.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('hererfgr'); 
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
    public function update(Request $request,School $school)
    {
        $school->update(['approved' => 1]);  
        return redirect(route('school.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        $school->delete();
        return redirect(route('school.index'));
    } 
}
