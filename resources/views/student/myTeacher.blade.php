@extends('layouts.theme')

@section('title')
about me
@endsection

@section('body')


<div style="color: #000">

<h3 style="margin-bottom: 40px;text-align: center;margin-top: 30px">{{$subject->name}} Teacher(s) of the Class: {{Auth::user()->student->sclass->class}}{{Auth::user()->student->sclass->section}}</h3>


 @foreach($teachers as $teacher)

<div class="card mb-3" style="margin-left: 190px">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img img src="{{asset('storage/'.$teacher->teacher->user->img)}}" style="height: 170px;width: 170px;margin-top: 25px" class="card-img" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">{{$teacher->teacher->user->name}} </h5>
        <p class="card-text"><b> DOB-</b> {{$teacher->teacher->DOB}}</p>
        <p class="card-text"><b> email-</b> {{$teacher->teacher->user->email}}</p>
        <p class="card-text"><b> Contact No.-</b> {{$teacher->teacher->contactNo}}</p>
        <p class="card-text"><b> Qualification-</b> {{$teacher->teacher->Qualification}}</p>
      </div>
    </div>
  </div>
</div>

@endforeach

</div>
@endsection


