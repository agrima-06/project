@extends('layouts.theme')

@section('title')
about me
@endsection

@section('body')


<div class="row" style="color: #000">
  	<div style="float: right;">
		<div style="font-size: 300%; text-align: center;">
		{{Auth::user()->name}}
		</div><br>
		<div style="text-align: center;font-size: 200%;">
		DOB- {{$student->DOB}}
		</div><br>
		<div style="text-align: center;font-size: 200%;">
		contact- {{$student->contactNo}}
		</div><br>
		<div style="text-align: center;font-size: 200%;">
			school- 
		@if(isset($student->school->name))
			{{$student->school->name}}
		@endif
		</div><br>

		<div style="text-align: center;font-size: 200%;">
		class- 	@if(isset($student->sclass->class))
		{{$student->sclass->class}}{{$student->sclass->section}}
		@endif
		</div><br>

        <a href="{{route('student.edit', $student->id)}}">Edit</a>

	</div>
	<div style="float: left;">
		<a href="{{asset('storage/'.auth()->user()->img)}}">
			<img src="{{asset('storage/'.auth()->user()->img)}}" style="border-radius: 50%;height: 250px;width: 250px;float: right;margin-top: 29px">
		</a>
	</div>

</div>
@endsection


