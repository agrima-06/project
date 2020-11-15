
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
  @foreach($test->testquestions as $question)
    {{$question->subject}} -> {{$question->noOfQuestions}} Ques of which <span id="uploadCount"> @php $x = $question->question; 
    $x = explode(",",$x); echo(count($x)); @endphp </span> uploaded <a href="{{route('add.question', $question->id)}}" class='btn btn-success btn-sm ml-2'>Add Que</a> <a href="{{route('added.questions', $question->id)}}" class='btn btn-warning btn-sm'>View Que</a> <br>;
  @endforeach
</div>

  @if($test->public==1)
    The Test is available to everyone
    The test Notification and Assignment will be available for everyone and Can Searched. <br>
    @if($test->promotion==1)
      Logo Will Appear Here. <button class="btn btn-success btn-sm">See How it will appear to public</button>
    @endif
  @endif

  <p class="mb-0">
    <a href="{{route('test.taker', $test->id)}}">Take Test</a>
  </p>
 </div>
</div>
@endsection 

@section('script')
<script type="text/javascript">

var a = $('#uploadCount').html();
console.log(parseInt(a)+1);
</script>
@endsection

