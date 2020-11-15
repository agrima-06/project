
@extends('layouts.theme2')

@section('title')
Home Admin 
@endsection

@section('content')
  <!--Student Content Row -->


<div class="row">
 <div class="alert alert-success" role="alert" style="width:100%;">
  <h4 class="alert-heading">Test {{$test->title}}</h4>
  <p>{{$test->keywords}}</p>
  <hr>
  <p class="mb-0">Board/institute/Commission: {{$test->institute}}</p>
  <p class="mb-0">Name of Exam:- {{$test->exam}}</p>
  <p class="mb-0">Test Dificulty:- {{$test->level}}</p>
  <p class="mb-0">Test Duration:- {{$test->duration}}min</p>
  <p class="mb-0">@if($test->published==0) unpublished @elseif($test->published==1) published @endif</p>

  @foreach($test->testshareds as $shared)
    {{$shared->school->name}} -> Class:{{$shared->sclass->class}}{{$shared->section->section}}<br>
  @endforeach
  

<div id="addQuestions">
    {{$testquestion->subject}} -> {{$testquestion->noOfQuestions}} Ques of which <span id="uploadCount"> 
    @php $x = $testquestion->question; 
      $x = explode(",",$x); echo(count($x)); 
    @endphp 
  </span> uploaded <a href="{{route('add.question', $testquestion->id)}}" class='btn btn-success btn-sm ml-2'>Add Que</a> <a href="{{route('added.questions', $testquestion->id)}}" class='btn btn-warning btn-sm'>View Que</a> <br>
</div>

  @if($test->public==1)
    The Test is available to everyone
    The test Notification and Assignment will be available for everyone and Can Searched. <br>
    @if($test->promotion==1)
      Logo Will Appear Here. <button class="btn btn-success btn-sm">See How it will appear to public</button>
    @endif
  @endif

  <p class="mb-0"></p>
 </div>
</div>

<div class="row">
  Add Question Content Box with Upload option from EXCEL. Link for viewing ADDED Questions @if(in_array("18", $questionArray)) {{count($questionArray)}} @else NO @endif</div>

<div class="row">
Search Bar
{{$testquestion->questions()}}
</div>
<div class="row">
  <ul class="list-group">
    <li class="list-group-item active">Cras justo odio <button class="btn btn-success click question14"  onclick="queSelected(14, 'insert')">@if(in_array("14", $questionArray)) selected @else select @endif</button> <span class="ml-3 deletequestion14" onclick="queSelected(14, 'delete')" style="display: none;">&times;</span>
    </li>
    <li class="list-group-item">Dapibus ac facilisis in <button class="btn btn-success click question15"  onclick="queSelected(15, 'insert')">select</button> <span class="ml-3 deletequestion15" onclick="queSelected(15, 'delete')" style="display: none;">&times;</span> </li>
    <li class="list-group-item">Morbi leo risus <button class="btn btn-primary click question16"  onclick="queSelected(16, 'insert')">select</button> <span class="ml-3 deletequestion16" onclick="queSelected(16, 'delete')" style="display: none;">&times;</span> </li>
    <li class="list-group-item">Porta ac consectetur ac <button class="btn btn-primary click question17"  onclick="queSelected(17, 'insert')">select</button> <span class="ml-3 deletequestion17" onclick="queSelected(17, 'delete')" style="display: none;">&times;</span></li>
    <li class="list-group-item">Vestibulum at eros <button class="btn btn-primary click question18"  onclick="queSelected(18, 'insert')">select</button><span class="ml-3 deletequestion18" onclick="queSelected(18, 'delete')" style="display: none;">&times;</span> </li>
  </ul>
</div>


@endsection 

@section('script')
<script type="text/javascript">


// var noOfQuestions = $('#uploadCount').html();
// $('#uploadCount').html(parseInt(noOfQuestions)+1);
// console.log(parseInt(noOfQuestions)+1);


function queSelected(id, message) {

  console.log("#question"+id);
    console.log(message);

  $.ajax({
    url: "{{route('update.question', $testquestion->id)}}",
    method: 'GET',
    data:{
      que_id: id,
      message: message,
      _token: $('input[name=_token]').val()
    },
    beforeSend: function() {
      $("#question"+id).addClass("loader");
    },
    success: function(data){
      //loop(data.data);
      console.log(data.success);
      //console.log('success');
      $("#question"+id).removeClass("loader");
      if(message == 'insert'){
        $(".question"+id).html('selected');
        $(".question"+id).addClass('disabled');
        $(".deletequestion"+id).css('display', '');
        var noOfQuestions = $('#uploadCount').html();
        $('#uploadCount').html(parseInt(noOfQuestions)+1);
        $(".question"+id).removeAttr("onclick");

      }
      else if(message = 'delete'){
        $(".question"+id).html('select');
        $(".question"+id).removeClass('disabled');
        $(".deletequestion"+id).css('display', 'none');
        var noOfQuestions = $('#uploadCount').html();
        $('#uploadCount').html(parseInt(noOfQuestions)-1);
          $(".question"+id).attr("onclick","queSelected("+id+", 'insert')");

      }
    }
  });
}


</script>
@endsection

