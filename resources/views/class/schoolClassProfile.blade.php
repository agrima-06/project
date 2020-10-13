@extends('layouts.theme2') 

@section('title')
Class details
@endsection

@section('css')
<style type="text/css">
/*.teacherList{
}*/



</style>

@section('content') 
<h2>Class Details::Class {{$sclass->class}}{{$section->section}}</h2><br>
<p>
  <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#students" aria-expanded="true" aria-controls="students">
    Students
  </button>
  <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#teachers" aria-expanded="false" aria-controls="teachers">
    Teachers
  </button>
  <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#subjects" aria-expanded="false" aria-controls="subjects">
    Subjects
  </button>
  <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#homeworks" aria-expanded="false" aria-controls="homeworks">
    HomeWorks
  </button>
</p>
<div class="collapse" id="students">
  <div class="card card-body">
    <div class="list-group">
      <button type="button" class="list-group-item list-group-item-action active text-center btn-success">
       Students
      </button>
        @foreach($students as $student)
        <div class="card">
          <div class="row no-gutters">
            <div class="col-md-3 d-flex justify-content-between">
              <div>
              <img src="{{asset('storage/'.$student->user->img)}}"  style="height: 75px; width: 75px;" class="card-img p-1" alt="...">
              </div>            
              <div class="card-body">
                {{$student->user->name}}  <br> {{$student->user->lname}}
              </div>
            </div>
            <div class="col-md-8">
                    <div class="d-flex justify-content-between">
                      <div><b> DOB-</b> {{$student->DOB}}</div>
                      <div><b> email-</b> {{$student->user->email}}</div>
                    </div>                  
                    <div class="d-flex justify-content-between">
                      <div><b> Contact No.-</b> {{$student->contactNo}}</div>
                      <div><b> Class-</b> {{$student->sclass->class}}{{$student->section->section}}</div>
                    </div>
            </div>
            <div class="col-md-1">
              <div class="d-flex flex-column bd-highlight">
                  <div>
             <a href="#" class="btn btn-success btn-circle btn-sm mt-2 ml-4" data-toggle="modal" onclick="assignStudentId({{$student->id}}, '{{$student->user->name}}')" data-target="#studentClassChange">
                <i class="fas fa-edit"></i>
              </a>
              </div>
                  <div>
              <a href="#" class="btn btn-danger btn-circle btn-sm mt-2 ml-4" data-toggle="modal" onclick="assignStudentId({{$student->id}}, '{{$student->user->name}}')" data-target="#studentDelete">
                <i class="fas fa-trash"></i>
              </a>
               </div>
                </div>
            </div>
          </div>
        </div>
        @endforeach
    </div>
  </div>
</div>
<div class="collapse" id="teachers">
  <div class="card card-body">
    <div class="list-group">
      <button type="button" class="list-group-item list-group-item-action active text-center btn-success">
       Teachers
      </button>
      @foreach($relations as $relation)
        @if(isset($relation->teacher))
          <div class="card">
            <div class="row no-gutters">
              <div class="col-md-3 d-flex justify-content-between">
                <div>
                  <img src="{{asset('storage/'.$relation->teacher->user->img)}}"  style="height: 75px; width: 75px;" class="card-img p-1" alt="...">
                </div>                
                <div class="card-body">
                  {{$relation->teacher->user->name}} <br> {{$relation->teacher->user->lname}}
                </div>
              </div>
              <div class="col-md-8">
                <div class="d-flex justify-content-between">
                  <div><b> Subject-</b> {{$relation->subject->name}}</div>
                  <div><b> Qualification-</b> {{$relation->teacher->Qualification}}</div>
                </div>                  
                <div class="d-flex justify-content-between">
                  <div><b> email-</b> {{$relation->teacher->user->email}}</div>
                  <div><b> DOB-</b> {{$relation->teacher->DOB}}</div>   
                </div>
                <div class="d-flex justify-content-between">
                  <div><b> Contact No.-</b> {{$relation->teacher->contactNo}};</div>
                  <div><b> Classes he/she teaches-</b>
                    @foreach($relation->teacher->assignedRoles() as $role) 
                      @if(isset($role)) 
                        {{$role->sclass->class}}{{$role->section->section}}:{{$role->subject->name}}; 
                      @endif
                    @endforeach
                  </div>
                </div>
              </div>
              <div class="col-md-1">
                <div class="d-flex flex-column bd-highlight">
                  <div>
                    <a href="#" class="btn btn-success btn-circle btn-sm mt-2 ml-4" data-toggle="modal" onclick="assignStudentId({{$student->id}}, '{{$student->user->name}}')" data-target="#">
                    <i class="fas fa-edit"></i>
                  </a>
                  </div>
                  <div>
                    <a href="#" class="btn btn-danger btn-circle btn-sm mt-2 ml-4" data-toggle="modal" onclick="assignStudentId({{$student->id}}, '{{$student->user->name}}')" data-target="#">
                    <i class="fas fa-trash"></i>
                  </a>
                  </div>
                </div>                
              </div>
            </div>
          </div>
        @endif
      @endforeach
    </div>
  </div>
</div>
<div class="collapse" id="subjects">
  <div class="card card-body">
    <div class="list-group">
      <button type="button" class="list-group-item list-group-item-action active text-center btn-success">
       Subjects <span class="badge badge-light float-right" onclick="console1('asas')"> Add New Subject</span>
      </button>
      <div class="card addteacher" style="display: none;">
        <div class="card-header">
          <form class="mb-0">
            <div class="form-row align-items-center">
              <div class="col-auto">
                <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                  <option selected>Select Subject</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
              </div>
              <div class="col-auto">
                <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                  <option selected>Select Teacher</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
              </div>
              <div class="col-auto">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="autoSizingCheck">
                  <label class="form-check-label" for="autoSizingCheck">
                    Make ClassTeacher
                  </label>
                </div>
              </div>
              <div class="col-auto">
                <button type="submit" class="btn btn-warning">Add Subject</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      @foreach($relations as $relation)
        @if(isset($relation->subject))
          <div class="card">
            <div class="row no-gutters" @if($relation->classteacher == 1) style="background-color: #b2d8d8;" @endif>
              <div class="col-md-1">
                <img src="{{asset('storage/'.$relation->teacher->user->img)}}" style="height: 75px; width: 75px;" class="card-img p-2" alt="...">
              </div>
              <div class="col-md-2">
                <div class="card-body">
                  {{$relation->subject->name}}  
                </div>
              </div>
              <div class="col-md-6">
                <div class="card-body teacherListName">
                   Taught by:@if(isset($relation->teacher)) {{$relation->teacher->user->name}}  {{$relation->teacher->user->lname}} @endif
                    @if($relation->classteacher == 1)
                      <span class="badge badge-light ml-2">ClassTeacher</span>
                    @else
                      <span class="makeClassTeacher badge badge-light ml-2">Make ClassTeacher</span>
                    @endif          
                </div>
              </div>
              <div class="col-md-3">
                <button class="btn btn-success btn-sm mr-2" style="margin-top: 5%">@if(isset($relation->teacher)) Change @else Assign @endif Teacher</button> 
                <button class="btn btn-danger btn-sm mr-2"  style="margin-top: 5%">delete</button>
              </div>
            </div>
          </div>
        @endif
      @endforeach
    </div>
  </div>
</div>


<div class="collapse" id="homeworks">
  <div class="card card-body">
    <div class="list-group">
      <button type="button" class="list-group-item list-group-item-action active text-center btn-success">
       Homeworks
      </button>


        @foreach($relations as $relation)        
          @if(isset($relation->subject))
            {{$relation->subject->name}}

          @if(count($relation->subject->classSubjectHomeworks($school->id, $sclass->id, $section->id)) !== 0)
            @foreach($relation->subject->classSubjectHomeworks($school->id, $sclass->id, $section->id) as $homework)

        <div class="card">
          <div class="row no-gutters">
            <div class="col-md-3 d-flex justify-content-between">
              <div>
              <img src=""  style="height: 75px; width: 75px;" class="card-img p-1" alt="...">
              </div>            
              <div class="card-body">
                  {{$homework->heading}}
              </div>
            </div>
            <div class="col-md-8">
                    <div class="d-flex justify-content-between">
                      <div><b> DOB-</b> </div>
                      <div><b> email-</b> </div>
                    </div>                  
                    <div class="d-flex justify-content-between">
                      <div><b> Contact No.-</b> </div>
                      <div><b> Class-</b> {</div>
                    </div>
            </div>
            <div class="col-md-1">
              <div class="d-flex flex-column bd-highlight">
                  <div>
             <a href="#" class="btn btn-success btn-circle btn-sm mt-2 ml-4" data-toggle="modal" onclick="assignStudentId()" data-target="#studentClassChange">
                <i class="fas fa-edit"></i>
              </a>
              </div>
                  <div> 
              <a href="#" class="btn btn-danger btn-circle btn-sm mt-2 ml-4" data-toggle="modal" onclick="assignStudentId()" data-target="#studentDelete">
                <i class="fas fa-trash"></i>
              </a>
               </div>
                </div>
            </div>
          </div>
        </div>
            @endforeach
          @else
            No HomeWork for this subject
          @endif
          @endif
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

$(document).ready(function() {
    $('.makeClassTeacher').css('display', 'none');
    $(".teacherListName").hover(function(){
      $(this).find(".makeClassTeacher").css('display', '');
      }, function(){
      $(this).find(".makeClassTeacher").css('display', 'none');
    });

});

function console1(msg){
  console.log(msg);
  $('.addteacher').toggle();
}

// var content = $("#blog_1").find(".entryContent").text().split(" ");
// var content = "orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";

// var slicedContent = content.slice(0,50);

// console.log(slicedContent+'....');

//   //$slicedContent = $content.slice(0,30);


 </script>
@endsection