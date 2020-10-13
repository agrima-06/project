@extends('layouts.theme2')

@section('title')
Home Admin 
@endsection

@section('content')

   <div class="content">

    <div class="module message">
      <div class="module-head">
        <h3>Students In Our School</h3>
      </div>
      <div class="module-option clearfix">
        <div class="pull-left">
          Filter : &nbsp;
          <div class="btn-group">
            <button class="btn">All</button>
            <button class="btn dropdown-toggle" data-toggle="dropdown">
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <li><a href="#">All</a></li>
              <li><a href="#">In Progress</a></li>
              <li><a href="#">Done</a></li>
              <li class="divider"></li>
              <li><a href="#">New task</a></li>
              <li><a href="#">Overdue Task</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="module-body table">               

        <table class="table table-message">
          <tbody>
            <tr class="heading">
              <td class="cell-title">Class</td>
              <td class="d-flex justify-content-end">Status</td>
            </tr>
          @foreach($students as $student)
          @if($student->approved == 1)
            <tr class="task">
              <td class="cell-title">
                <p>
                  <a data-toggle="collapse" href="#student{{$student->id}}" role="button" aria-expanded="false" aria-controls="student{{$student->id}}">
                    {{$student->user->name}}
                  </a>
                </p>
                <div class="collapse" id="student{{$student->id}}">
                  <div class="card card-body">
                    <div class="row no-gutters">
                        <div class="col-md-3">
                          <img src="{{asset('storage/'.$student->user->img)}}" style="height: 140px; width: 150px; border-radius: 50%" class="card-img p-2" alt="...">
                        </div>
                        <div class="col-md-8">
                          <div class="card-body">
                              <h4 class="card-title text-center">{{$student->user->name}}  </h4>
                                <div class="d-flex justify-content-between">
                                  <p class="card-text"><b> DOB-</b> {{$student->DOB}}</p>
                                  <p class="card-text"><b> email-</b> {{$student->user->email}}</p>
                                </div>                  
                                <div class="d-flex justify-content-between">
                                  <p class="card-text"><b> Contact No.-</b> {{$student->contactNo}}</p>
                                  <p class="card-text"><b> Class-</b> {{$student->sclass->class}}{{$student->section->section}}</p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                  </div>
                </div>
              </td>
              <td class="cell-time align-right">
                <div class="d-flex flex-row bd-highlight  d-flex justify-content-end">
                  <div class="p-2 bd-highlight">                
                    <form action="{{route('student.destroy',$student->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                  </form>
                  </div>
                </div>
              </td>
            </tr>
          @endif
          @endforeach
          </tbody>
        </table>
      </div>
      <div class="module-foot">
      </div>
    </div>
    
  </div><!--/.content-->
            
@endsection
