@foreach($practicequestions as $practicequestion)
<div class="card mt-5 text-left">
  <div class="card-header ">
    {{$loop->iteration}}) {{$practicequestion->question}}
  </div>
  <div class="card-body options pb-1 pt-1">
    <blockquote class="blockquote mb-0 options">
    <div onclick="checkAnswer(@if($practicequestion->answer->correct_option =='A')'correctA{{$practicequestion->id}}'@else'wrongA{{$practicequestion->id}}'@endif)" data-toggle="collapse" @if($practicequestion->answer->correct_option =='A') href="#Explanation{{$practicequestion->id}}"@else wrongA{{$practicequestion->id}} @endif >
      @if(isset($practicequestion->answer->optionA))
        A) {{$practicequestion->answer->optionA}}<span id=@if($practicequestion->answer->correct_option =='A')'correctA{{$practicequestion->id}}'@else'wrongA{{$practicequestion->id}}'@endif></span><br>
      @endif
    </div>
      @if(isset($edit))
        <span class="text-right float-right">
         <a class="btn btn-warning" href="{{route('practiceQuestion.edit', $practicequestion->id)}}">Edit</a>
          <a class="btn btn-danger">Delete</a>
        </span>
      @endif
     <div onclick="checkAnswer(@if($practicequestion->answer->correct_option =='B')'correctB{{$practicequestion->id}}'@else'wrongB{{$practicequestion->id}}'@endif)" data-toggle="collapse" @if($practicequestion->answer->correct_option =='B') href="#Explanation{{$practicequestion->id}}"@else wrongB{{$practicequestion->id}} @endif >
      @if(isset($practicequestion->answer->optionB))
        B) {{$practicequestion->answer->optionB}}<span id=@if($practicequestion->answer->correct_option =='B')'correctB{{$practicequestion->id}}'@else'wrongB{{$practicequestion->id}}'@endif></span><br>
      @endif
    </div>

     <div onclick="checkAnswer(@if($practicequestion->answer->correct_option =='C')'correctC{{$practicequestion->id}}'@else'wrongC{{$practicequestion->id}}'@endif)" data-toggle="collapse" @if($practicequestion->answer->correct_option =='C') href="#Explanation{{$practicequestion->id}}"@else wrongC{{$practicequestion->id}} @endif >
      @if(isset($practicequestion->answer->optionC))
        C) {{$practicequestion->answer->optionC}}<span id=@if($practicequestion->answer->correct_option =='C')'correctC{{$practicequestion->id}}'@else'wrongC{{$practicequestion->id}}'@endif></span><br>
      @endif
    </div>

      <div onclick="checkAnswer(@if($practicequestion->answer->correct_option =='D')'correctD{{$practicequestion->id}}'@else'wrongD{{$practicequestion->id}}'@endif)" data-toggle="collapse" @if($practicequestion->answer->correct_option =='D') href="#Explanation{{$practicequestion->id}}"@else wrongD{{$practicequestion->id}} @endif >
        @if(isset($practicequestion->answer->optionD))
         D) {{$practicequestion->answer->optionD}} <span id=@if($practicequestion->answer->correct_option =='D')'correctD{{$practicequestion->id}}'@else'wrongD{{$practicequestion->id}}'@endif></span><br>
        @endif
      </div>

      <div onclick="checkAnswer(@if($practicequestion->answer->correct_option =='E')'correctE{{$practicequestion->id}}'@else'wrongE{{$practicequestion->id}}'@endif)" data-toggle="collapse" @if($practicequestion->answer->correct_option =='E') href="#Explanation{{$practicequestion->id}}"@else wrongE{{$practicequestion->id}} @endif >
        @if(isset($practicequestion->answer->optionE))
         E) {{$practicequestion->answer->optionE}}<span id=@if($practicequestion->answer->correct_option =='E')'correctE{{$practicequestion->id}}'@else'wrongE{{$practicequestion->id}}'@endif></span><br>
        @endif
           <span class="text-right float-right mt-n4 text-muted" data-toggle="tooltip" data-placement="top" title="@if(isset($practicequestion->user->teacher)){{$practicequestion->user->teacher->school->name}}, {{$practicequestion->user->teacher->school->city}}@endif"><h6>Posted by-{{$practicequestion->user->name}}</h6></span>
      </div>
   
    </blockquote>
  </div>
      <div class="card-footer text-muted">
        <div class="d-flex justify-content-around">
            <div>
              Discuss
            </div>
            <div>
              <a class="btn btn-secondary btn-sm" data-toggle="collapse" href="#Hint{{$practicequestion->id}}" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Hint</a>
            </div>
            <div>
              <a class="btn btn-secondary btn-sm" data-toggle="collapse" href="#Explanation{{$practicequestion->id}}" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Show Answer</a>
            </div>
        </div>
    </div>
    <div class="collapse multi-collapse" id="Explanation{{$practicequestion->id}}">
      <div class="card card-body">
        <div class="alert alert-success" role="alert">         
          Correct Answer is: {{$practicequestion->answer->correct_option}} 
            @if($practicequestion->answer->correct_option=='A')
              ({{$practicequestion->answer->optionA}})
            @elseif($practicequestion->answer->correct_option=='B')
              ({{$practicequestion->answer->optionB}})
            @elseif($practicequestion->answer->correct_option=='C')
              ({{$practicequestion->answer->optionC}})
            @elseif($practicequestion->answer->correct_option=='D')
             ({{$practicequestion->answer->optionD}})
            @elseif($practicequestion->answer->correct_option=='E')
             ({{$practicequestion->answer->optionE}})
            @endif
          <br>
          @if(isset($practicequestion->answer->explanation))
            {{$practicequestion->answer->explanation}}
          @endif
        </div>
      </div>
    </div>
    <div class="collapse multi-collapse" id="Hint{{$practicequestion->id}}">
      <div class="card card-body">
        <div class="alert alert-success" role="alert">         
          @if(isset($practicequestion->answer->hint))
           {{$practicequestion->answer->hint}}
          @endif

          <p class='right' >&#10004;</p>
          <p class='wrong' >&#10006;</p>
        </div>
      </div>
    </div>

  </div>

@endforeach