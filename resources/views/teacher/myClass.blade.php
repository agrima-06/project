@extends('layouts.theme')

@section('title')
about me
@endsection

@section('body')


<div class="row" style="color: #000">

<h3>Student of the Class: {{$sclass->class}} {{$sclass->section}}</h3>

<table class="table table-bordered">
  <thead>
    
  	<tr>
  		<th scope="col" colspan="7" style="color:blue;">The Table shows last 4 Homeworks</th>
  	</tr>

    <tr>
      <th scope="col" rowspan="2">Sl No</th>
      <th scope="col" rowspan="2">Image</th>
      <th scope="col" rowspan="2">Name</th>
      @foreach(Auth::user()->Homeworks->reverse() as $homework)
		@if($loop->iteration == 5)
			@break
		@endif
		<th scope="col">HW{{$loop->iteration}} <br>{{$homework->topic}}</th>	
	  @endforeach  
    </tr>

     <tr>
    @foreach(Auth::user()->Homeworks->reverse() as $homework)
		@if($loop->iteration == 5)
			@break
		@endif
      <th>{{$homework->created_at}}</th>
	@endforeach  

    </tr>

  </thead>
  <tbody>

 @foreach($students as $student)

<!-- 	show all the details of the student when the teacher clicks on the name of the student
 -->

    <tr>
      <th scope="row">1</th>
      <td><img src="{{asset('storage/'.$student->user->img)}}" style="height: 100px;width: 100px;margin-top: 25px"></td>
      <td>{{$student->user->name}}</td>
      <td></td>
      <td></td>
      <td></td>

    </tr>

@endforeach

  </tbody>
</table>


 Last three homeworks assigned by me

 Homework1->
 Completed (yes/No)-> if Yes mark it green and click option to view, if No mark it Red <br>

 Homework2->
 Completed (yes/No)-> if Yes mark it green and click option to view, if No mark it Red <br>

 Homework2->
 Completed (yes/No)-> if Yes mark it green and click option to view, if No mark it Red <br>

</div>
@endsection


