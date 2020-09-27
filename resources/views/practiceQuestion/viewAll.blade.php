
@extends('layouts.theme')

@section('title')
Home
@endsection

@section('body')

<div class="justify-content-center mt-5" style="color: black;margin-bottom: 10%">
 
  @if(Auth::user()->role=="teacher")

  <form method="get" action="{{route('practiceQuestion.index')}}">
    <div class="form-row align-items-center">
      <div class="col-sm-2 my-1">
        <label  class="sr-only" for="sel1">Select list (select one):</label>
        <select class="form-control" name="class_id" id="sel1" onChange="getSubject(this.value);">
          <option>Select Class</option>
          @if(isset($relations))
           @foreach($relations as $relation)
              <option  value="{{$relation->sclass->id}}" @if(isset($action) && ($sclass->id== $relation->sclass->id)) selected @endif 
               >Class {{$relation->sclass->class}}</option>
            @endforeach
          @endif                           
        </select>
      </div>
      <div class="col-sm-3 my-1">
        <label  class="sr-only" for="subject">Select list (select one):</label>
        <select class="form-control" name="subject" id="subject" >
          @if(isset($action)) 
            <option>{{$subject->name}}</option>
          @else
            <option>Select a Subject</option>
          @endif
        </select>
      </div>
      <div class="col-auto my-1">
        <label  class="sr-only" for="sel1">Select list (select one):</label>
        <select class="form-control" name="action" id="sel1">        
          <option value="1" >Add Questions</option>
          <option value="2" @if(isset($action) && $action==2)
              selected
           @endif>
          View/Edit questions uploaded by me</option>
          <option value="3" @if(isset($action) && $action==3)
            selected
          @endif 
          >View questions uploaded by others</option>
        </select>
      </div>
      <div class="col-auto my-1">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </form>


@if(isset($action) && $action == 1)
  <form method="post" action="{{route('practiceQuestion.store')}}" id="question" enctype="multipart/form-data" class="mt-5 text-left">
    @csrf
    <div class="row">
      <div class="col">
        <input type="hidden" class="form-control" id="exampleFormControlInput5" name="class_id"  value="{{$sclass->id}}"> 
        <input type="text" class="form-control" id="exampleFormControlInput5" value="Class {{$sclass->class}}" selected disabled> 
      </div>
      <div class="col">
        <input type="hidden" class="form-control" id="exampleFormControlInput5" name="subject_id"  value="{{$subject->id}}"> 
        <input type="text" class="form-control" id="exampleFormControlInput5" value="{{$subject->name}}" selected disabled> 
      </div>
    </div>

    <div class="row">
      <div class="col mt-3">
        <label  class="sr-only" for="sel1"></label>
        <select class="form-control" name="topic" id="sel1" onChange="getSubtopic(this.value, {{$subject->id}});">
          <option>Select Topic</option>
            @if(isset($topics))
             @foreach($topics as $topic)
                <option  value="{{$topic->topic}}">{{$topic->topic}}</option>
             @endforeach
            @endif                           
        </select>
      </div>

      <div class="col mt-3">
        <label  class="sr-only" for="sub_topic"></label>
          <select class="form-control" name="subtopic_id" id="sub_topic">
            <option>Select a Sub-Topic</option>                           
          </select>
      </div>
      <div class="col mt-3">
        <label  class="sr-only" for="level">Level</label>
          <select class="form-control" name="Level" id="level">
            <option value="1">Level-1</option>
            <option value="2">Level-2</option>                           
            <option value="3">Level-3</option>                          
          </select>
      </div>
      </div>

      <div class="form-group mt-3">
        <label for="exampleFormControlTextarea1">Question</label>
        <textarea class="form-control" name="question" id="exampleFormControlTextarea1" rows="4"></textarea>
      </div>

      <div class="row">
       <div class="col">
        <label for="exampleFormControlTextarea1">Option A</label>
        <textarea class="form-control" name="optionA" id="exampleFormControlTextarea1" rows="2"></textarea>
       </div>
       <div class="col">
          <label for="exampleFormControlTextarea1">Option B</label>
          <textarea class="form-control" name="optionB" id="exampleFormControlTextarea1" rows="2"></textarea>
       </div>
       <div class="col">
          <label for="exampleFormControlTextarea1">Option C</label>
          <textarea class="form-control" name="optionC" id="exampleFormControlTextarea1" rows="2"></textarea>
       </div>
      </div>

      <div class="row mt-3">
       <div class="col">
        <label for="exampleFormControlTextarea1">Option D</label>
        <textarea class="form-control" name="optionD" id="exampleFormControlTextarea1" rows="2"></textarea>
       </div>
       <div class="col">
          <label for="exampleFormControlTextarea1">Option E</label>
          <textarea class="form-control" name="optionE" id="exampleFormControlTextarea1" rows="2"></textarea>
       </div>
        <div class="col">
        <label for="exampleFormControlInput10">Correct Option</label>
        <select class="form-control" name="correct_option" id="exampleFormControlSelect10" name="correct_option">
            <option value="A">OptionA</option>
            <option value="B">OptionB</option>
            <option value="C">OptionC</option>
            <option value="D">OptionD</option>
            <option value="E">OptionE</option>
          </select>
        </div>
      </div>

  <div class="form-group">
    <label for="exampleFormControlInput11">Hint</label>
    <input type="text" name="hint" class="form-control" id="exampleFormControlInput11" name="hint" placeholder="Add video link or any other links here...">
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea12">Explanation</label>
    <textarea class="form-control" name="explanation" id="exampleFormControlTextarea12" rows="3" placeholder="Add  What should be Answer And why..."></textarea>
  </div>
  <div class="form-group">
    <label for="exampleFormControlFile13">Add File as Explanation/Hint</label>
    <input type="file" class="form-control-file" id="exampleFormControlFile13"  name="file_url">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button> 
</form>


  @elseif(isset($action) && $action == 2)

      @include('partials.practiceQuestion.questionView')


  @elseif(isset($action) && $action == 3)

      @include('partials.practiceQuestion.questionView')

  @endif

@endif

@if(Auth::user()->role=="student")

  @if(count($topics))
  @foreach($topics as $topic)
    <div class="d-flex justify-content-around shadow p-4 mt-3 bg-white rounded">
      <div class="col-4">{{$topic}}</div>
      <div class="col-4">
        @foreach($subtopics as $subtopic)
          @if($subtopic->topic->topic == $topic)       
             <a href="{{route('sort.question', [$subtopic->topic->id, $subtopic->topic->topic.$subtopic->topic->sub_topic])}}">{{$subtopic->topic->sub_topic}}</a>
             <br>
          @endif
        @endforeach
      </div>   
    </div>
       @endforeach
   @else
      No Data of this section.
   @endif

@endif

</div>
@endsection

  <!-- include('partials.ajax.ajaxSubject') -->
  @section('script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script language="JavaScript">
  function getSubject(val) {
    $.ajax({
      url: "{{route('ajax.practice.subject')}}",
      method: 'POST',
      data:{
        class_id: val,
        _token: $('input[name=_token]').val()
      },
      beforeSend: function() {
        $("#subject").addClass("loader");
      },
      success: function(data){
        loop(data.data);
        console.log(data.data);
        $("#subject").removeClass("loader");
      }
    });
  }

  function loop(data){
      console.log(data[0]);
      var options = '<option> Select a Subject </option>';
      for(var i = 0; i < data.length; i++) {
      var obj = data[i];
      options = options + '<option value='+obj+'>'+obj+'</option>';        
      }
      $("#subject").html(options);
  }

  function getSubtopic(val, subject_id) {
    $.ajax({
      url: "{{route('ajax.practice.subtopic')}}",
      method: 'POST',
      data:{
        topic: val,
        subject_id: subject_id,
        _token: $('input[name=_token]').val()
      },
      beforeSend: function() {
        $("#sub_topic").addClass("loader");
      },
      success: function(data){
        tloop(data.subtopics);
        //console.log(data.subtopics);
        $("#sub_topic").removeClass("loader");
      }
    });
  }

  function tloop(subtopics){
      var options = '<option>Select a Sub-Topic</option>';
      for(var i = 0; i < subtopics.length; i++) {
      var obj = subtopics[i];
      options = options + '<option value='+obj.id+'>'+obj.sub_topic+'</option>';        
      }
      $("#sub_topic").html(options);
  }


  //Make This in partials later 
   $(".collapse").on('show.bs.collapse', function(){
    //alert('The collapsible content is about to be shown.');
    $(".collapse").collapse('hide');

  });

    function checkAnswer(id){
      //var className = this.id;
        

        if (id.includes("wrong")) {
                   // console.log('#'+id);

           $('#'+id).html('&#10006;');
        } 
        else{
         // console.log('#'+id);

          //console.log('right');
          //console.log(#id);

          $('#'+id).html('&#10004;');
         // $('#Explanation7').show();
        }     
     // $(.correct).html
      //$(.wrong).html
      //$('#id').css('display', '');
    }

</script>
 
@endsection


