 
@extends('layouts.theme2') 

@section('title')
Home Admin 
@endsection

@section('css')
<style type="text/css">
.centerText{
   text-align: center;
}
</style>
@endsection

@section('content')

   <div class="content">
    <div class="module message">
      <div class="module-head">
        <h3>Task Management Tool</h3>
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
        <div class="pull-right">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-warning float-right mb-2" data-toggle="modal" data-target="#addNewClass">
            Add Class
          </button>        
          </div>
        </div>
      </div>
      <div class="module-body table">               

        <table class="table table-message">
          <tbody>
            <tr class="heading">
              <td class="cell-title centerText">Title</td>
              <td class="cell-title centerText">Subject</td>
              <td class="cell-title centerText">Topic</td>
              <td class="cell-title centerText">Class</td>
              <td class="cell-title centerText">Posted <br> Expiry Date</td>
              <td class="cell-title centerText">Action</td>
            </tr>
          @foreach($teacher->homeworks as $homework)
                <tr class="task">
		              <td class="cell-title centerText">{{$homework->title}}</td>
		              <td class="cell-title centerText">{{$homework->subject->name}}</td>
                  <td class="cell-title centerText">{{$homework->topic->topic}}</td>
                  <td class="cell-title centerText">{{$homework->sclass->class}}{{$homework->section->section}}</td>  
                  <td class="cell-title centerText"">      Posted $ Expiry date 		              </td>
                  <td class="cell-title centerText"">     Action                  </td>

		            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>  <!--/.content-->

    <!-- Delete Class Modal-->
    <div class="modal fade" id="classDelete" tabindex="-1" role="dialog" aria-labelledby="classDelete" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="Class">Remove Class <span class="className"></span> from School?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
            <div class="modal-body">
              Once deleted all associated students/teachers/subjects data will permanently be removed. 
            </div>
          <div class="modal-footer">          
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form action="{{route('delete.school.class')}}" id="classDeleteSchool" method="post">
              @csrf
              <input type="hidden" name="school_id" value="{$school_id}">
              <input type="hidden" name="sclass_id" value="">
              <input type="hidden" name="section_id" value="">
              <button type="submit" class="btn btn-danger">Delete Class</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Change ClassTeacher Modal-->
    <div class="modal fade" id="changeClassTeacher" tabindex="-1" role="dialog" aria-labelledby="changeClassTeacher" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="Class">Select New Class Teacher</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
              <form>
                <div class="form-group row">
                  <div class="col-sm-10 classTeacherClass">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-10 ">
                    <select class="assignteacher" name="relation_id"  style="width: 75%">
                      <option></option>                  
                      <option value=""> Rahul </option>
                    </select>
                  </div>
                </div>
              </form> 
          </div>
          <div class="modal-footer">          
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form action="{{route('delete.school.class')}}" id="classDeleteSchool11" method="post">
              @csrf
              <input type="hidden" name="school_id" value="{$school_id}">
              <input type="hidden" name="sclass_id" value="">
              <input type="hidden" name="section_id" value="">
              <button type="submit" class="btn btn-danger">Delete Class</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!--Add New Class Modal -->
    <div class="modal fade" id="addNewClass" tabindex="-1" aria-labelledby="addNewClass" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="as">Add Class & Section in your School</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action= "{{route('school.add.class')}}" id="storeClass">
                @csrf
              <input type="hidden" name="school_id" value="{$school_id}">
              <div class="form-group">
                <div class="col-sm-10 ">
                  <select class="assignclass" name="sclass_id"  style="width: 75%">
                    <option></option>
                    foreach($sclasses as $sclass)                  
                    <option value="{$sclass->id}">Class {$sclass->class}</option>
                    endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10 ">
                  <select class="assignsection" name="section_id"  style="width: 75%">
                    <option></option>
                    foreach($sections as $section)                  
                    <option value="{$section->id}">{$section->section}</option>
                    endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="form-group form-check">
                  <input type="checkbox" class="form-check-input" id="subjectSyllabus" name="default_subjects" value="1">
                  <label class="form-check-label" for="subjectSyllabus">Add default subject in Class as per CBSE Syllabus</label>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
            <button type="button" class="btn btn-success" onclick="storeClass.submit();">Add Class</button>
          </div>
        </div>
      </div>
  </div>
 						
@endsection

@section('script')
<script type="text/javascript">

function assignClassSectionId(classId, classname, sectionId, sectionname){
  window.classId = classId;
  window.classname = classname;
  window.sectionId = sectionId;
  window.sectionname = sectionname;
  //console.log(studentname);
  $(".className").html(window.classname+window.sectionname);
  $('input[name="sclass_id"]').val(classId);
  $('input[name="section_id"]').val(sectionId);
  $(".classTeacherClass").html('Select New ClassTeacher of Class '+window.classname+window.sectionname);
  getTeacher({$school_id}, classId, sectionId);
}

$(document).ready(function() {
    $('.assignteacher').select2({
    placeholder: "Select Teacher",
    allowClear: true
    });
    $('.assignclass1').select2({
    placeholder: "Select class",
    allowClear: true
    });$('.assignsection1').select2({
    placeholder: "Select section",
    allowClear: true
    });
});

///Here Starts AJAX FOR DATA 
function getTeacher(school_id, class_id, section_id) {
   console.log(school_id + class_id + section_id);
    $.ajax({
      url: "{{route('school.class.teacherlist')}}",
      method: 'POST',
      data:{
        school_id: school_id,
        sclass_id: class_id,
        section_id: section_id,
        _token: $('input[name=_token]').val()
      },
      beforeSend: function() {
        $(".assignteacher").addClass("loader");
      },
      success: function(data){
        sloop(data.data);
        console.log(data.data);
        $(".assignteacher").removeClass("loader");
      }
    });
  }  

  function sloop(data){
      console.log(data[0]);
      var options = '<option> </option>';
      for(var i = 0; i < data.length; i++) {
      var obj = data[i];
      options = options + '<option value='+obj.id+'>'+obj.teacher+'</option>';        
      }
      $(".assignteacher").html(options);
  }

</script>
@endsection