
@extends('layouts.theme')

@section('title')
Home Admin 
@endsection

@section('body')

<div class="row justify-content-center">
	<div class="col-8">
	<form method="post" action="{{route('school.store')}}">
		@csrf
	  <div class="form-row">
	    
	      <input type="text" class="form-control" placeholder="school name" name="name" style="margin-top: 50px;">
	    
	      <input type="text" class="form-control" placeholder="your city" name="city" style="margin-top: 15px;">
	    
	      <input type="text" class="form-control" placeholder="your state" name="state" style="margin-top: 15px;">
	    
	      <input type="text" class="form-control" placeholder="school address" name="address" style="margin-top: 15px;">
	    
	      <input type="text" class="form-control" placeholder="affilated_to" name="affilated_to" style="margin-top: 15px;">
	  </div>
	    <button type="submit" class="btn btn-primary" style="margin-top: 11px">Submit</button>
	</form>
	</div>
</div>
@endsection
