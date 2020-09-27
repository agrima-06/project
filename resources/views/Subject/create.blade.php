
@extends('layouts.theme')

@section('title')
Home Admin 
@endsection

@section('body')

<div class="row justify-content-center">
	<form method="post" action="{{route('subject.store')}}">
		@csrf
	  <div class="form-row">
	    <!-- <div class="col">
	      <input type="number" class="form-control" placeholder="school name" name="school_id">
	    </div> -->
	    <div class="col">
	      <input type="text" class="form-control" placeholder="Add subject" name="subject" style="margin-top: 15px">
	    </div>
	  </div>
	    <button type="submit" class="btn btn-primary" style="margin-top: 15px">Submit</button>
	</form>
</div>
@endsection
