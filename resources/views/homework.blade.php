
@extends('layouts.theme')

@section('title')
Home
@endsection

@section('body')


    <div class="row justify-content-center">
  <div class="col-8">
        <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="margin-top: 33px">
      Add Home Work
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              <span class="badge badge-light" style="font-size: 18px;">Add HomeWork</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            @include('partials.homeworkForm')
          </div>
        </div>
      </div>
    </div>

  <div class="container-fluid">
    <div>
	<ul class="list-group d-flex align-items-center" style="margin-top: 10%">
	  @foreach($homeworks as $homework)

	  <li class="list-group-item d-flex justify-content-between align-items-center"  style="margin-bottom: 5%;width: 100%">
    
	  	<span class="badge badge-light badge-pill" style="font-size: 18px;margin-right: 5%">{{$homework->subject->name}}</span>
	    <span class="badge badge-light badge-pill" style="font-size: 18px;margin-right: 5%">{{$homework->topic->topic}}</span>
	     <span class="badge badge-light badge-pill" style="font-size: 18px;margin-right: 5%">{{$homework->topic->sub_topic}}</span>

      <form action="{{route('homework.show',$homework->id)}}" method="get" style="margin-right: 1%">
         <button type="submit" class="btn btn-primary btn-sm mr-2">View</button>
      </form>

      <form action="{{route('homework.edit',$homework->id)}}" method="get" style="margin-right: 1%">
         <button type="submit" class="btn btn-primary btn-sm mr-2">Edit</button>
      </form>
      
	    <form action="{{route('homework.destroy',$homework->id)}}" method="post">
	    	@csrf
	    	@method('DELETE')
	    	<button type="submit" class="btn btn-danger btn-sm">Delete</button>
		  </form>

	  </li>
	  @endforeach
	</ul>

  </div>
  </div>
 

  </div>
</div> 
@endsection

  @include('partials.ajax.ajaxSubject')
