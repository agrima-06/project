
@extends('layouts.theme2')

@section('title')
Home Admin 
@endsection

@section('content')

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>
  <!--Student Content Row -->
  <div class="row">
      <!-- Pending Requests Card Example -->
      <div class="col-12 mb-4">
        <h6 class="m-0 mb-2 font-weight-bold text-primary"> Student School Joining Request::-</h6>  @foreach($school->students as $student)
          @if($student->approved == 0)
        <div class="card mb-3" style="max-width: 100%;">
          <div class="row no-gutters">
            <div class="col-md-2 p-2"  style="text-align: center;">
              <img src="{{asset('storage/'.$student->user->img)}}" class="rounded-circle p-2" alt="No Image" style="text-align: center;" width="80px" height="80px" >
              {{$student->user->name}}
            </div>
            <div class="col-md-10">
              <div class="card-body">                          
                <div class="d-flex justify-content-between">
                  <div>
                    <h5 class="card-title">Requested class: @if(isset($student->sclass->class)) {{$student->sclass->class}}@endif @if(isset($student->section->section)) {{$student->section->section}} @endif</h5>
                    <b> DOB-</b> {{$student->DOB}}<br>
                    <b> email-</b> {{$student->user->email}}<br>
                    <b> Contact No.-</b> {{$student->contactNo}}<br>
                  </div>
                  <div>
                    <form action="{{route('admin.approval',$student->id)}}" method="post">
                      @csrf
                      <input type="hidden" name="student" value="1">
                      <button  class="btn btn-success btn-circle btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Class">
                        <i class="fas fa-edit"></i>
                      </button>
                    </form>
                    <form action="{{route('admin.approval',$student->id)}}" method="post" class="mt-2">
                      @csrf
                      <input type="hidden" name="student" value="1">
                      <button  class="btn btn-success btn-circle btn-sm" data-toggle="tooltip" data-placement="top" title="Approve">
                        <i class="fas fa-check"></i>
                      </button>
                    </form>
                    <form action="{{route('admin.approval',$student->id)}}" method="post" class="mt-2">
                      @csrf
                      <input type="hidden" name="studentDelete" value="1">
                      <button type="submit" class="btn btn-danger btn-circle btn-sm" data-toggle="tooltip" data-placement="top" title="Delete">
                        <i class="fas fa-trash"></i>
                      </button>
                    </form>                           
                  </div>
                </div>                         
              </div>
            </div>
          </div>
        </div>
          @endif
        @endforeach
      </div>               
  </div>
  <!--Teacher Content Row -->
  <div class="row">
      <!-- Pending Requests Card Example -->
      <div class="col-12 mb-4">                  
          <h6 class="m-0 font-weight-bold text-primary">Teachers School Joining Request::-</h6>
        @foreach($school->teachers as $teacher)
          @if($teacher->approved == 0)
        <div class="card mb-2" style="max-width:100%;">
          <div class="row no-gutters">
            <div class="col-md-2 p-2" style="text-align:center;">
              <img src="{{asset('storage/'.$teacher->user->img)}}" class="rounded-circle p-2" alt="No Image" style="text-align:center;" width="80px" height="80px">
              {{$teacher->user->name}}, {{$teacher->Qualification}}
            </div>
            <div class="col-md-10">
              <div class="card-body">                          
                <div class="d-flex justify-content-between">
                  <div>
                    <h5 class="card-title">{{$teacher->school->name}}</h5>
                    <b> DOB-</b> {{$teacher->DOB}}<br>
                    <b> email-</b> {{$teacher->user->email}}<br>
                    <b> Can Teach</b>@foreach($teacher->subjects as $subject) {{$subject->name}} @endforeach
                    <b> in Classes-</b>@foreach($teacher->sclasses as $sclass) {{$sclass->class}}, @endforeach<br>
                    <div style="display:none;">
                    <b > Role Assigned:-</b>
                    <span class="oldAssignedRoles{{$teacher->id}}">
                    @foreach($teacher->assignedRoles() as $role) 
                      @if(isset($role)) 
                        Class{{$role->sclass->class}}{{$role->section->section}}->{{$role->subject->name}}; 
                      @endif
                    @endforeach
                    </span>
                    </div>
                    <br>

                  </div>
                  <div>                         
                    <form action="{{route('admin.approval',$teacher->id)}}" method="post" class="mt-2">
                      @csrf
                      <input type="hidden" name="teacher" value="1">
                      <button  class="btn btn-success btn-circle btn-sm" data-toggle="tooltip" data-placement="top" title="Approve">
                        <i class="fas fa-check"></i>
                      </button>
                    </form>
                    <form action="{{route('admin.approval',$teacher->id)}}" method="post" class="mt-2">
                      @csrf
                      <input type="hidden" name="teacherDelete" value="1">
                      <button type="submit" class="btn btn-danger btn-circle btn-sm" data-toggle="tooltip" data-placement="top" title="Delete">
                        <i class="fas fa-trash"></i>
                      </button>
                    </form>                           
                  </div>
                </div>                         
              </div>
            </div>
          </div>
        </div>
          @endif
        @endforeach
      </div> 
      <div class="col-12 mb-4">                  
          <h6 class="m-0 font-weight-bold text-primary">Teachers Role Request::-</h6>
        @foreach($school->teachers as $teacher)
          @foreach($teacher->schoolTeacherRelations as $relation)
            @if($relation->approved == 0)                      
        <div class="card mb-2" style="max-width:100%;">
          <div class="row no-gutters">
            <div class="col-md-1 p-2" style="text-align:center;">
              <img src="{{asset('storage/'.$teacher->user->img)}}" class="rounded-circle p-2" alt="No Image" style="text-align:center;" width="70px" height="70px">
            </div>
            <div class="col-md-11">
              <div class="card-body">                          
                <div class="d-flex justify-content-between">
                  <div>
                    <h5 class="card-title">{{$teacher->user->name}} has requested for teaching in  Class{{$relation->sclass->class}}{{$relation->section->section}} -> {{$relation->subject->name}}.@if($relation->classteacher == 1)  She proposed to be 'Class Teacher' of the Class{{$relation->sclass->class}}{{$relation->section->section}} also. btn-sm @endif</h5>
                  </div>
                  <div>
                    <a href="#" class="btn btn-success btn-circle btn-sm" data-toggle="modal" onclick="assignTeacherId({{$teacher->id}}, '{{$teacher->user->name}}')" data-target="#TeacherRoleModal">
                      <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{route('admin.approval',$relation->id)}}" method="post" class="mt-2">
                      @csrf
                      <input type="hidden" name="teacherRole" value="1">
                      <button  class="btn btn-success btn-circle btn-sm" data-toggle="tooltip" data-placement="top" title="Approve">
                        <i class="fas fa-check"></i>
                      </button>
                    </form>
                    <form action="{{route('admin.approval',$relation->id)}}" method="post" class="mt-2">
                      @csrf
                      <input type="hidden" name="teacherRoleDelete" value="1">
                      <button type="submit" class="btn btn-danger btn-circle btn-sm" data-toggle="tooltip" data-placement="top" title="Delete">
                        <i class="fas fa-trash"></i>
                      </button>
                    </form>                           
                  </div>
                </div>                         
              </div>
            </div>
          </div>
        </div>
            @endif
          @endforeach
        @endforeach
      </div>               
  </div>
  <!-- End Pending Request -->
  <div class="row" style="display: none;">
    <div class="col-xl-3 col-md-6 mb-4">
       <!-- Brand Buttons -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Notices/Messages</h6>
        </div>
        <div class="card-body">
          <p>Google and Facebook buttons are available featuring each company's respective brand color. They are used on the user login and registration pages.</p>
          <p>You can create more custom buttons by adding a new color variable in the <code>_variables.scss</code> file and then using the Bootstrap button variant mixin to create a new style, as demonstrated in the <code>_buttons.scss</code> file.</p>
          <a href="#" class="btn btn-google btn-block"><i class="fab fa-google fa-fw"></i> .btn-google</a>
          <a href="#" class="btn btn-facebook btn-block"><i class="fab fa-facebook-f fa-fw"></i> .btn-facebook</a>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <a href="{{route('class.show', $school->id)}}">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2"> 
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Classes</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">@if(count(Auth::user()->teacher->iteachClasses($school->id)) > 0) {{count(Auth::user()->teacher->iteachClasses($school->id))}} @endif
                 <!-- if(count($schools) > 0) {count($schools)} endif -->
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
      </a> 
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <a href="{{route('practiceQuestion.index')}}">  
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Practice Questions</div> 
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                @if(count(Auth::user()->teacher->practiceQuesPosted()) > 0) {{count(Auth::user()->teacher->practiceQuesPosted())}} @endif
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
      </a>
    </div>
    
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <a href="{{route('homework.index')}}">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Homeworks</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">@if(count(Auth::user()->teacher->homeworksAssigned()) > 0) {{count(Auth::user()->teacher->homeworksAssigned())}} @endif <b>+</b></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
      </a>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <a href="{{route('objectivetest.show', $user_id)}}">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Tests</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
     </a>
    </div>               
  </div>

  <div class="row">
    <div class="col-12 mb-4">
      <div class="card shadow mb-4 alert alert-success" role="alert" id="student-list">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-success">Teachers list</h6>
        </div>
        <div class="card-body">
          @foreach($school->students as $student)
            {{$student->user->name}}<br>
          @endforeach
        </div>
      </div>
    </div>               
  </div>

  <div class="row">
    <div class="col-12 mb-4">
    <!-- Basic Card Example students list -->
    <div class="card shadow mb-4 alert alert-info" role="alert" id="teacher-list">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info">Students list</h6>
      </div>
      <div class="card-body">
        @foreach($school->teachers as $teacher)
          {{$teacher->user->name}}<br>
        @endforeach
      </div>
    </div>
    </div>         
  </div>    
<!-- Teacher Assign Role Modal-->
  <div class="modal fade" id="TeacherRoleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Assign Class-Subject Role to <span class="teacherName"></span></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="clearModal()">
            <span aria-hidden="true">×</span>
          </button>
        </div>
          <div class="modal-body">
            <form>
              <div class="input-group-text">
                <select class="assignclass" name="class_id" onChange="getSection({{$school->id}},this.value);">
                  <option></option>
                  @foreach($school->classes() as $class)
                    <option value="{{$class->sclass->id}}">Class: {{$class->sclass->class}}</option>
                  @endforeach
                </select>
                <select class="assignsection" name="section_id" onChange="getSubject({{$school->id}},this.value);">
                  <option></option>
                    <option value=""></option>
                </select>
                <select class="assignsubject" name="subject">
                  <option></option>
                </select>
              </div>
              <a href="#" class="btn btn-primary btn-sm" onclick="savedata(0, 0)">Assign</a>
            </form>
            <div class="teacherAlreadyAssigned" style="display: none;">
                  
            </div>
            <hr>
            <div class="assignedroles" style="display: none;">
            
            </div>
           <div class="oldRoles">
            Assigned Roles:-
          </div>
        </div>
        <div class="modal-footer">          
          <button class="btn btn-secondary" type="button" data-dismiss="modal" onclick="clearModal()">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <div class="defaultClassList" style="display: none;">
    <option></option>
    @foreach($school->classes() as $class)
    <option value="{{$class->sclass->id}}">Class: {{$class->sclass->class}}</option>
    @endforeach
  </div> 						
@endsection 

@section('script')
<script type="text/javascript">
  $(document).ready(function() {
      $('.assignclass').select2({
      placeholder: "Select Class",
      allowClear: true
      });
      $('.assignsection').select2({
      placeholder: "Select Section",
      allowClear: true
      });
      $('.assignsubject').select2({
      placeholder: "Select Subject",
      allowClear: true
      });
  });

  function assignTeacherId(teacherId, teachername){
    window.teacherId = teacherId;
    window.teachername = teachername;
    console.log(teachername);
    $(".teacherName").html(window.teachername);
    var role = $( ".oldAssignedRoles"+teacherId).text();
    console.log("<strong>Assigned Roles:</strong>"+role);
    $( ".oldRoles").html("<strong>Assigned Roles:</strong>"+role);
  }

function savedata(reassign, deleted){
  var x = $( ".assignclass option:selected" ).text();
  var y = $( ".assignsection option:selected" ).text();
  var z = $( ".assignsubject option:selected" ).text();
  var a = $( ".assignclass option:selected" ).val();
  var b = $( ".assignsection option:selected" ).val();
  var c = $( ".assignsubject option:selected" ).val();
  console.log(x+y+'->'+z+a);
  console.log(a+b+c);

  $.ajax({
    url: "{{route('ajax.teacher.role')}}",
    method: 'POST',
    data: {
        teacher_id: window.teacherId,
        school_id: {{$school->id}},
        sclass_id: a,
        section_id: b,
        subject_id: c,
        reassign_role:reassign,
        delete_role:deleted,
         _token: $('input[name=_token]').val()
    },
    success: function(data){
      if (data.hasOwnProperty('oldteacher')) {
        $('.teacherAlreadyAssigned').css('display','');
        $('.teacherAlreadyAssigned').html('<hr>'+z+' in '+x+' '+y+' is already taught by <a href="#">'+data.oldteacher+'</a>. Do you really want to reassign?? <button class="btn btn-secondary btn-sm" onclick="savedata(1, 0)">YES</button>   <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-danger btn-sm" onclick="clearModal()"> NO </button>');
      //console.log(data.oldteacher);
      }
      else if (data.hasOwnProperty('deleted')) {
        $('.teacherAlreadyAssigned').css('display','');
        $('.teacherAlreadyAssigned').html('<hr>'+x+y+'->'+z+' has been removed.');
      //console.log(data.oldteacher);
      }

      else if (data.hasOwnProperty('sameteacher')) {
        $('.teacherAlreadyAssigned').css('display','');
        $('.teacherAlreadyAssigned').html('<hr>'+x+y+'->'+z+' has already been assigned to this teacher.<button type="button" class="btn btn-danger btn-sm" onclick="savedata(0, 1)">Delete Role</button>');
      //console.log(data.oldteacher);
      }

      else {
         $(".teacherAlreadyAssigned").html('<hr>'+x+y+'->'+z+' has been assigned. <button type="button" class="btn btn-danger btn-sm" onclick="savedata(0, 1)">Delete Role</button>'); 
         $(".teacherAlreadyAssigned").css('display', '');
      }
    },
    error: function(data){
        alert("fail");
    }
  }); 
}

//Clear Modal on CLose

function clearModal(){
  var cleardata = '<option> </option>';

  var classlist = $(".defaultClassList").html();

    //console.log(classlist);
    $(".assignclass").html(classlist);
    $(".assignsection").html(cleardata);
    $(".assignsubject").html(cleardata);
    $(".teacherAlreadyAssigned").css('display','none');
    $(".assignedroles").css('display','none');
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

  function getSubject(sval, section) {
    var sclass_id = $( ".assignclass option:selected" ).val();
    console.log(sclass_id + sval + section)
    $.ajax({
      url: "{{route('ajax.admin.subject')}}",
      method: 'POST',
      data:{
        school_id: sval,
        sclass_id: sclass_id,
        section_id: section,
        _token: $('input[name=_token]').val()
      },
      beforeSend: function() {
        $(".assignsubject").addClass("loader");
      },
      success: function(data){
        tloop(data.data);
        console.log(data.data);
        $(".assignsubject").removeClass("loader");
      }
    });
  }

  function tloop(subjects){
    var options = '<option></option>';
    for(var i = 0; i < subjects.length; i++) {
    var obj = subjects[i];
    options = options + '<option value='+obj.id+'>'+obj.subject+'</option>';        
    }
    $(".assignsubject").html(options);
  }

</script>
@endsection