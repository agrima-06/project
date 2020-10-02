@extends('layouts.theme2') 

@section('title')
Class details
@endsection

@section('content') 
<h2>Class Details::Class {{$sclass->class}}{{$section->section}}</h2><br>
<p>
  <a class="students btn btn-primary" data-toggle="collapse" href="#students" role="button" aria-expanded="true" aria-controls="students" style="background-color: #20c9a6;">
    Students
  </a>
  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#teachers" aria-expanded="false" aria-controls="teachers"  style="background-color: #20c9a6;">
    Teachers
  </button>
</p>
<div class="collapse" id="students">
  <div class="card card-body">
    <div class="list-group">
      <button type="button" class="list-group-item list-group-item-action active text-center" style="background-color: #20c9a6;">
       Students
      </button>
      <ul class="list-group">
        @foreach($students as $student)
        <li class="list-group-item p-2">
          <div class="row no-gutters">
            <div class="col-md-2">
              <img src="{{asset('storage/'.$student->user->img)}}" style="height: 140px; width: 150px; border-radius: 50%" class="card-img p-2" alt="...">
            </div>
            <div class="col-md-7">
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
            <div class="col-md-3">
             <a href="#" class="btn btn-success btn-circle btn-sm mt-2" data-toggle="modal" onclick="assignStudentId({{$student->id}}, '{{$student->user->name}}')" data-target="#studentClassChange" style="margin-left: 120px">
                <i class="fas fa-edit"></i>
              </a>
              <a href="#" class="btn btn-danger btn-circle btn-sm mt-2" data-toggle="modal" onclick="assignStudentId({{$student->id}}, '{{$student->user->name}}')" data-target="#studentDelete" style="margin-left: 120px">
                <i class="fas fa-trash"></i>
              </a>
            </div>
          </div>
        </li>
        @endforeach
      </ul>  
    </div>
  </div>
</div>
<div class="collapse" id="teachers">
  <div class="card card-body">
    <div class="list-group">
      <button type="button" class="list-group-item list-group-item-action active text-center"  style="background-color: #20c9a6;">
       Teachers
      </button>
      @foreach($relations as $relation)
          <div class="card">
            <div class="row no-gutters">
              <div class="col-md-2">
                <img src="{{asset('storage/'.$relation->teacher->user->img)}}" style="height: 150px; width: 150px; border-radius: 50%;margin-top: 13%" class="card-img p-2" alt="...">
              </div>
              <div class="col-md-7">
                <div class="card-body">
                  <h4 class="card-title text-center">{{$relation->teacher->user->name}} </h4>
                    <div class="d-flex justify-content-between">
                      <p class="card-text"><b> Subject-</b> {{$relation->subject->name}}</p>
                      <p class="card-text"><b> Qualification-</b> {{$relation->teacher->Qualification}}</p>
                    </div>                  
                    <div class="d-flex justify-content-between">
                      <p class="card-text"><b> email-</b> {{$relation->teacher->user->email}}</p>
                      <p class="card-text"><b> DOB-</b> {{$relation->teacher->DOB}}</p>
                    </div>
                    <div class="d-flex justify-content-between">
                      <p class="card-text"><b> Contact No.-</b> {{$relation->teacher->contactNo}}; </p>
                          <p class="card-text"><b> Classes he/she teaches-</b>
                          @foreach($relation->teacher->assignedRoles() as $role) 
                                @if(isset($role)) 
                                  {{$role->sclass->class}}{{$role->section->section}}:{{$role->subject->name}}; 
                                @endif
                              @endforeach
                            </p>
                    </div>
                </div>
              </div>
              <div class="col-md-3">
                <a class="d-flex justify-content-center btn btn-success mr-2" href="" style="margin-left: 120px;margin-top: 5%">Edit</a> 
                <a class="d-flex justify-content-center btn btn-danger mr-2" href="" style="margin-left: 120px;margin-top: 5%">delete</a>
              </div>
            </div>
          </div>
      @endforeach
    </div>
  </div>
</div>
<!-- Student Change Class Modal-->
  <div class="modal fade" id="studentClassChange" tabindex="-1" role="dialog" aria-labelledby="studentClassChange" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="studentClass">Migrate <span class="studentName"></span>  to New Class </h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="refreshpage()">
            <span aria-hidden="true">×</span>
          </button>
        </div>
          <div class="modal-body">
            <form>
              <div class="input-group-text">
                <select class="assignclass" name="class_id" onChange="getSection({{$school->id}},this.value);">
                  <option></option>
                  @foreach($school->classes() as $class)
                    <option value="{{$class->sclass->id}}" @if($class->sclass->id == $sclass->id) selected @endif>Class: {{$class->sclass->class}}</option>
                  @endforeach
                </select>
                <select class="assignsection" name="section_id">
                  <option></option>
                  @foreach($classSections as $classSection)
                    <option value="{{$classSection->section_id}}" @if($classSection->section_id == $section->id) selected @endif>sec {{$classSection->section->section}}</option>
                  @endforeach
                </select>
                <a href="#" class="btn btn-primary btn-sm ml-2" onclick="saveStudentClass()">Assign</a>
              </div>
            </form>
            <hr>
           <div class="CurrentClass">
              Current Class:- Class{{$sclass->class}}{{$section->section}}
          </div>
        </div>
        <div class="modal-footer">          
          <button class="btn btn-secondary" type="button" data-dismiss="modal" onclick="refreshpage()">Cancel</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Student Delete Class Modal-->
  <div class="modal fade" id="studentDelete" tabindex="-1" role="dialog" aria-labelledby="studentDelete" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="studentClass">Remove <span class="studentName"></span> from School?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
          <div class="modal-body">
            Once Removed from School Student cannot be re-added by School. Hence, you should remove only if student has left school. Alternatively you can Remove Student From Class only. 
            <form action="" id="studentDeleteClass" method="post">
               @csrf
              <input type="hidden" name="studentDeleteClass" value="1">
             <button type="button" class="btn btn-warning btn-sm" onclick="submitDeleteStudent('studentDeleteClass')">Remove From Class</button>           
            </form> 
        </div>
        <div class="modal-footer">          
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <form action="" id="studentDeleteSchool" method="post">
            @csrf
            <input type="hidden" name="studentDeleteSchool" value="1">
            <button type="button" class="btn btn-danger" onclick="submitDeleteStudent('studentDeleteSchool')">Remove from School</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
<script type="text/javascript">
     // $('.collapse').collapse()
$(".collapse").on('show.bs.collapse', function(){
  //alert('The collapsible content is about to be shown.');
  $(".collapse").collapse('hide');
});

$(document).ready(function(){
  $('#students').collapse('show');
 // $('.students').addClass('active')
});

function assignStudentId(studentId, studentname){
  window.studentId = studentId;
  window.studentname = studentname;
  console.log(studentname);
  $(".studentName").html(window.studentname);
  //var role = $( ".oldAssignedRoles"+studentId).text();
  //console.log("<strong>Assigned Roles:</strong>"+role);
 // $( ".oldRoles").html("<strong>Assigned Roles:</strong>"+role);
}
function submitDeleteStudent(id){
  $('#'+id).attr('action', "{{asset('admin/approvals')}}/"+window.studentId);
  $('#'+id).submit();
}

///Here Starts AJAX FOR DATA 
function getSection(sval, cval) {
   console.log(sval + cval);
    $.ajax({
      url: "{{route('ajax.admin.section')}}",
      method: 'POST',
      data:{
        school_id: sval,
        sclass_id: cval,
        _token: $('input[name=_token]').val()
      },
      beforeSend: function() {
        $(".assignsection").addClass("loader");
      },
      success: function(data){
        sloop(data.data);
        console.log(data.data);
        $(".assignsection").removeClass("loader");
      }
    });
  }  

  function sloop(data){
      console.log(data[0]);
      var options = '<option> </option>';
      for(var i = 0; i < data.length; i++) {
      var obj = data[i];
      options = options + '<option value='+obj.id+'>'+'sec '+obj.section+'</option>';        
      }
      $(".assignsection").html(options);
  }


$(document).ready(function() {
    $('.assignclass').select2({
    placeholder: "Select Class",
    allowClear: true
    });

    $('.assignsection').select2({
    placeholder: "Select Section",
    allowClear: true
    });
});

//Refresh Page on reload of modal so as Students can be fixed. 
function refreshpage(){
 location.reload();
}

function saveStudentClass(){
  var x = $( ".assignclass option:selected" ).text();
  var y = $( ".assignsection option:selected" ).text();
  var a = $( ".assignclass option:selected" ).val();
  var b = $( ".assignsection option:selected" ).val();
  //console.log(x+y+'->'+z+a);
  console.log(a+b+x+y);
  $.ajax({
    url: "{{route('ajax.student.class')}}",
    method: 'POST',
    data: {
        student_id: window.studentId,
        //school_id: {{$school->id}},
        sclass_id: a,
        section_id: b,
         _token: $('input[name=_token]').val()
    },
    success: function(data){
      if (data.hasOwnProperty('sameClass')) {
        $('.CurrentClass').css('display','');
       $('.CurrentClass').html('Student is already in '+ data.sameClass.class + data.sameClass.section );
      }
      else {
        $(".CurrentClass").css('display', '');
        $('.CurrentClass').html('Student has been migrated to: '+data.data.class + data.data.section);

      }
    },
    error: function(data){
        alert("fail");
    }
  }); 
}


 </script>
@endsection