
@extends('layouts.theme2')

@section('title')
Home Admin 
@endsection

@section('content')
  <!--Student Content Row -->
  <div class="card">
  <div class="card-body">
        <h5 class="card-title">Card title</h5>

<div class="row">
  <form method="post" action="{{route('objectivetest.store')}}">
    @csrf
    <div class="form-row">
      <div class="col-md-4 mb-3">
        <input type="text" class="form-control is-valid" id="title" name="title" placeholder="Test Title" required>
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>
      <div class="col-md-8 mb-3">
        <input type="text" class="form-control is-valid" id="keywords" name="keywords" placeholder="Search Keywords" required>
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="col-md-3 mb-3">
        <select class="custom-select is-invalid" id="institute" name="institute" onchange="myOtherInstitute()" placeholder="Board/Institute/Commission" aria-describedby="validationServer04Feedback" required>
          <option selected disabled value="">Board/Institute/Commission</option>
          @foreach($boards as $board)
            <option value="{{$board->boards}}">{{$board->boards}}</option>
          @endforeach 
            <option value="other">Other</option>
        </select>
        <div id="validationServer05Feedback" class="invalid-feedback">
          Please provide a valid zip.
        </div>
         <div id="otherInstitute" style="display:none;">
            <input name="otherInstitute" class="form-control" type="text" placeholder="Please Specify:">
         </div>
      </div>
      <div class="col-md-3 mb-3">
        <select class="custom-select is-invalid" id="exam" name="exam" onchange="myOtherExam()" placeholder="select Class/Exam" aria-describedby="validationServer04Feedback" required>
          <option selected disabled value="">select Class/Exam.</option>
          <option>SSC CGL</option>
          <option>Bank PO</option>
          <option>Bank Clerk</option>
          <option>Terminal</option>
          <option>Half Yearly</option>
          <option value="other">Other</option>
        </select>
        <div id="validationServer05Feedback" class="invalid-feedback">
          Please provide a valid zip.
        </div>      
        <div id="otherExam" style="display:none ;">
          <input name="otherExam" class="form-control" type="text" placeholder="Please Specify:">
        </div>       
      </div>
      <div class="col-md-3 mb-3">
        <select class="custom-select is-invalid" id="level" name="level" placeholder="select Class/Exam" aria-describedby="validationServer04Feedback" required>
          <option selected disabled value="">Difficulty</option>
          <option value="1">Easy</option>
          <option value="2">Medium</option>
          <option value="3">Hard</option>
        </select>
      </div>
      <div class="col-md-3 mb-3">
        <input type="number" class="form-control is-invalid" id="duration" name="duration" placeholder="Duration(min)" aria-describedby="validationServer05Feedback" min="1" max="360" required>
        <div id="validationServer05Feedback" class="invalid-feedback">
          Please provide a valid zip.
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="col-md-6">
        <table class="table">
          <thead class="thead-dark">
            <tr>    
              <th scope="col" style="width:70%;">Subject</th>
              <th scope="col">No of Ques</th>
              <th scope="col"><button class="btn btn-primary btn-sm" onclick="addSubjectRow()">Add Subjects</button></th>
            </tr>
          </thead>
          <tbody class="tableBody">
            <tr>
              <td>
                  <select id="subject1" class="custom-select" name="subject1" onchange="myFunction('subject1','otherSubject1')" style="width:80%;">
                    @foreach($subjects as $subject)
                      <option value="{{$subject->id}}">{{$subject->name}}</option>
                    @endforeach 
                      <option value="0">Other</option>         
                  </select>
                  <div id="otherSubject1" style="display: none;">
                    <input name="otherSubject1" class="form-control" type="text" placeholder="Please Specify:">
                  </div>
              </td>
              <td>
                <input type="number" name="subject1question" min="1"  style="width:150%;">
              </td>
            </tr>      
          </tbody>
        </table>
      </div>
      <div class="col-md-3">
        <select class="custom-select" id="shareWith" name="shareWith[]" multiple="multiple" style="width:90%;">
          <option selected disabled value="">Share With</option>
          @foreach($classes as $class)
          <option value="{{$class->id}}">Class:{{$class->id}} {{$class->sclass->class}}{{$class->section->section}}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-3">
        <div class="form-check">
          <input class="form-check-input" name="public" type="checkbox" id="public" value="1">
          <label class="form-check-label" for="public">
            Share with Everyone
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" name="promotion" type="checkbox" id="promotion" value="1">
          <label class="form-check-label" for="promotion">
            want to Promote?
          </label>
        </div>
        <div class="form-group mt-2">
          <button class="btn-sm btn btn-primary">Add Promotion</button>
        </div>
      </div>
    </div>
<!--     <div class="form-row">
      <div class="col-md-6">
        <div class="d-flex justify-content-around">
          <div class="p-0" style="width:80%;">
            <select class="custom-select id="subject1" name="subject1" onchange="myFunction('subject1','otherSubject1')" style="width:90%;">
              <option value="volvo">Volvo</option>
              <option value="saab">Saab</option>
              <option value="fiat">Fiat</option>
              <option value="audi">Audi</option>
            </select>
            <div id="otherSubject1" style="display: none;">
              <input name="otherSubject1" type="text" placeholder="Please Specify:">
            </div>
          </div>
          <div>
            <input type="number" class="form-control
            " name="subject1question" min="1"  style="width:60%;" placeholder="questions">
          </div>
          <div>
            <button class="btn btn-primary btn-sm" onclick="addSubjectRow()">Add Subjects</button>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <select class="custom-select id="subject1" name="subject1" onchange="myFunction('subject1','otherSubject1')" style="width:90%;">
          <option value="volvo">Public</option>
          @foreach($classes as $class)
          <option value="$class->id">Class: {{$class->sclass->class}}{{$class->section->section}}</option>
          @endforeach
        </select>
      </div>
    </div> -->
    <div class="form-row">
      <div class="col-md-6 mb-3">
        <div class="form-check">
          <input class="form-check-input is-invalid" type="checkbox" value="1" id="terms" aria-describedby="invalidCheck3Feedback" required>
          <label class="form-check-label" for="invalidCheck3">
            Agree to terms and conditions
          </label>
          <div  id="invalidCheck3Feedback" class="invalid-feedback">
            You must agree before submitting.
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-3">
        <button class="btn btn-primary" type="submit" style="width: 100%;">Submit form</button>
      </div>
    </div>
  </form>  
</div>
</div></div>						
@endsection 

@section('script')
<script type="text/javascript">

window.count = 1;
function addSubjectRow(){
  var options =  "@foreach($subjects as $subject) <option value='{{$subject->id}}''>{{$subject->name}}</option> @endforeach"+"<option value='0'>Other</option>";
  console.log(options);

  count = count + 1;
  if(count<7){
   var addId = 'subject'+count;
    var otherSubjectaddId = 'otherSubject'+count;
    $('.tableBody').append("<tr><td><select id="+addId+" class='custom-select' name="+addId+" onchange=myFunction('"+addId+"','"+otherSubjectaddId+"') style='width:80%;'>"+options+"</select><div id='otherSubject"+count+"' style='display: none;'><input name='otherSubject"+count+"'type='text' placeholder='Please Specify:'></div></td><td><input type='number' name='subject"+count+"question' min='1' style='width:150%;'></td></tr>");
  }
  else{
    console.log('no more subject allowed'); 
  }
}


function myFunction(id, otherId){
  if ($('#'+id).val() == '0') {
        $('#'+otherId).show();
  }
  else{
    $('#'+otherId).hide();
  }
  console.log($('#'+id).val());
}


function myOtherInstitute(){
  if ($('#institute').val() == 'other') {
        $('#otherInstitute').show();
  }
  else{
    $('#otherInstitute').hide();
  }
}

function myOtherExam(){
  if ($('#exam').val() == 'other') {
        $('#otherExam').show();
  }
  else{
    $('#otherExam').hide();
  }
}
// $('select[name=subject]').change(function () {
//     if ($(this).val() == 'audi') {
//         $('#browserother').show();
//     } else {
//         $('#browserother').hide();
//     }
// });
</script>
@endsection

