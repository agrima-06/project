@extends('layouts.theme')

@section('title')
My Homework:: Student
@endsection

@section('body')

<div class="row">
	<div class="container-fluid">
	<ul class="list-group d-flex align-items-center" style="margin-top: 10%">
		@if(count($homeworks) > 0)
		  @foreach($homeworks as $homework)
		  <li class="list-group-item d-flex justify-content-between align-items-center"  style="margin-bottom: 1%;width: 70%">
	     	 <span class="badge badge-light badge-pill" style="font-size: 18px;margin-right: 1%">{{$homework->subject->name}}</span>		
		  	 <span class="badge badge-light badge-pill" style="font-size: 18px;margin-right: 1%">{{$homework->topic}}</span>
	        <a href="{{route('homework.show',$homework->id)}}" class="btn btn-primary btn-sm mr-2" style="margin-right: 1%">View</a>
	        
		  </li>
		  @endforeach
		  @else
		  NO HomeWork in this category
		  @endif
	</ul>
	</div>
</div>
@endsection