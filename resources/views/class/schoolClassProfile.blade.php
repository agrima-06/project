@extends('layouts.theme2') 

@section('title')
Class details
@endsection

@section('script')
Home Admin 
@endsection 
@section('content') 

<h2>Class Details:</h2><br>

<div class="list-group">
  <button type="button" class="list-group-item list-group-item-action active text-center">
   Teacher
  </button>
  @foreach($relations as $relation)
  <ul class="list-group">
    <li class="list-group-item p-2">
      <a data-toggle="collapse" href="#teachers" aria-controls="students">
        <img src="{{asset('storage/'.$relation->teacher->user->img)}}" style="height: 90px;margin-right: 4%;width: 90px;" class="card-img" alt="...">{{$relation->subject->name}} Teacher :: {{$relation->teacher->user->name}}
      </a>
    </li>
  </ul>  
  <div class="collapse" id="teachers">
    <div class="card card-body">
      <div class="card">
        <div class="row no-gutters">
          <div class="col-md-3">
            <img src="{{asset('storage/'.$relation->teacher->user->img)}}" style="height: 170px;width: 170px;" class="card-img p-2" alt="...">
          </div>
          <div class="col-md-6">
            <div class="card-body">
              <h4 class="card-title">{{$relation->teacher->user->name}} </h4>
              <p class="card-text"><b> Subject-</b> {{$relation->subject->name}}</p>
              <p class="card-text"><b> DOB-</b> {{$relation->teacher->DOB}}</p>
              <p class="card-text"><b> email-</b> {{$relation->teacher->user->email}}</p>
              <p class="card-text"><b> Contact No.-</b> {{$relation->teacher->contactNo}}; </p>
              <p class="card-text"><b> Qualification-</b> {{$relation->teacher->Qualification}}</p>
            </div>
          </div>
          <div class="col-md-3">
            <a class="d-flex justify-content-center btn btn-success mr-2" href="" style="margin-left: 120px;margin-top: 5%">Edit</a> 
            <a class="d-flex justify-content-center btn btn-danger mr-2" href="" style="margin-left: 120px;margin-top: 5%">delete</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>
  <br><br>
<div class="list-group">
  <button type="button" class="list-group-item list-group-item-action active text-center">
   Students
  </button>
  @foreach($students as $student)
  <ul class="list-group">
    <li class="list-group-item p-2">
      <a data-toggle="collapse" href="#students" role="button" aria-expanded="true" aria-controls="students">
        <img src="{{asset('storage/'.$relation->teacher->user->img)}}" style="height: 90px;margin-right: 4%;width: 90px;" class="card-img" alt="...">{{$student->user->name}}
      </a>
    </li>
  </ul>  
  <div class="collapse" id="students">
    <div class="card card-body">
      <div class="card">
        <div class="row no-gutters">
          <div class="col-md-3">
            <img src="{{asset('storage/'.$student->user->img)}}" style="height: 170px;width: 170px;" class="card-img p-2" alt="...">
          </div>
          <div class="col-md-6">
            <div class="card-body">
              <h4 class="card-title">{{$student->user->name}} </h4>
              <p class="card-text"><b> DOB-</b> {{$student->DOB}}</p>
              <p class="card-text"><b> email-</b> {{$student->user->email}}</p>
              <p class="card-text"><b> Contact No.-</b> {{$student->contactNo}}</p>
            </div>
          </div>
          <div class="col-md-3">
            <a class="d-flex justify-content-center btn btn-success mr-2" href="" style="margin-left: 120px;margin-top: 5%">Edit</a> 
            <a class="d-flex justify-content-center btn btn-danger mr-2" href="" style="margin-left: 120px;margin-top: 5%">delete</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>

@endsection