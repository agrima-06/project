
@extends('layouts.theme2')

@section('title')
Edit
@endsection

@section('body')

<div class="row mt-2 mb-2" >
	<div class="container-fluid">
		<div class="card text-center"  style="background-color: #f3f7d3">
		  <div class="card-header">
		    <h2>{{$homework->subject->name}}</h2>
		  </div>
		  <div class="card-body" >
		    <h5 class="card-title">{{$homework->topic}}</h5>
		    <p class="card-text">{{$homework->content}}</p>
		    <hr>
		    Attached Documents:- 
		    @foreach($homework->Homeworkfiles as $file)
		    	<a href="{{asset('storage/'.$file->url)}}">Document-{{$loop->iteration}}</a>

		    @endforeach
		    <hr>
		    Hint: {{$homework->hint}}
		  </div>
		  <div class="card-footer text-muted">
		    <div class="d-flex justify-content-around">
		    	<div>
		    		{{$homework->updated_at}}
		    	</div>
		    	<div>
		    		Assigned By Teacher:- {{$homework->User->name}}
		    	</div>
		    	<div>
		    		<b class="text-success">Submit Your Homework Below</b>
		    	</div>
		    </div>
		  </div>
		</div>
	</div>
</div>

@if(Auth::user()->role=="student")
<div class="row mb-2" >
	<div class="container-fluid">
		<form action="{{route('homework.submit', $homework->id)}}" method="post" class="shadow p-3 mb-5 bg-white rounded border">
			@csrf		  
		  <div class="form-group">
		    <label for="exampleFormControlTextarea1">Your answer:-</label>
		    <textarea class="form-control" id="exampleFormControlTextarea1" rows="8" placeholder="Put Your Homework Here.." name="answer"></textarea>
		  </div>
		  <div class="form-group">
		    <label for="exampleFormControlInput1">Report Error/ Confusion</label>
		    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Report Error/Confusion Detail Here." name="error">
		  </div>
		    <input type="file" name="url" >		  
		  	<button type="submit" class="btn btn-primary">Submit Homework</button>
		</form>
  </div>
</div>			        
@endif

@endsection



