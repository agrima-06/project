@extends('layouts.theme')

@section('title')
about me
@endsection

@section('body') 
<form method="post" action="{{route('student.update', $student->id)}}" enctype="multipart/form-data"  style="margin-right: 27%;margin-left: 2%;">
  
<h1>About Me</h1>
  @csrf
  @method('PUT')
    <div class="form-row">
      <div class="form-group col-md">
        <label for="inputAddress">DOB</label>
        <input type="text" class="form-control" id="DOB" placeholder="enter DD/MM/YY" name="DOB" value="{{isset($student)?$student->DOB: ''}}">
      </div>
      
      <div class="form-group col-md">
        <label for="inputAddress">Contact Number</label>
        <input type="text" class="form-control" id="contactNo" placeholder="enter your contact" name="contactNo" value="{{isset($student)?$student->contactNo: ''}}">
      </div>
    </div>

    <div class="form-group">
      <label for="sel1">Select School:</label>
      <select class="form-control" id="sel1" name="schoolId">
        @foreach($schools as $school)
          <option value="{{$school->id}}">{{$school->name}}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="sel2">Select Class:</label>
      <select class="form-control" id="sel2" name="classId">
        @foreach($classes as $class)
          <option value="{{$class->id}}">{{$class->class}}{{$class->section}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group row">
      <label for="exampleFormControlFile1" class=" text-md-right">Please upload your profile photo</label>
      <div class="col-md"> 
        <input type="file" class="form-control-file" name="img">
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
@endsection