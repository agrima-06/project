
  <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

<button id="startTest" onclick="startTest()">START TEST</button>

@foreach($objectivetest->testquestions as $testsubject)
  {{$testsubject->subject}}<br>
   @foreach($testsubject->questions() as $question)
    <div class="questions" id="{{$testsubject->id}}{{$question->id}}" style="display:none">
     {{$loop->iteration}} {{$question->question}} <br>
        <div class="options form-check">

      <input type="radio" id="optionA" name="option" value="optionA">
      <label for="optionA">{{$question->answer->optionA}}</label><br>
      <input type="radio" id="optionB" name="option" value="optionB">
      <label for="optionB">{{$question->answer->optionB}}</label><br>
      <input type="radio" id="optionC" name="option" value="optionC">
      <label for="optionC">{{$question->answer->optionC}}</label><br>
      <input type="radio" id="optionD" name="option" value="optionD">
      <label for="optionD">{{$question->answer->optionD}}</label><br>
          </div>

    </div>
   @endforeach
    <br>
@endforeach



@foreach($objectivetest->testquestions as $testsubject)
  {{$testsubject->subject}}<br>
   @foreach($testsubject->questions() as $question)
     <span class="btn btn-primary" onclick="myQuestion('{{$testsubject->id}}{{$question->id}}')">{{$loop->iteration}}</span>
   @endforeach
    <br>
@endforeach


  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  <!-- Custom scripts for all pages-->
  <script src="{{asset('js/sb-admin-2.js')}}"></script>
  

  <script type="text/javascript">
   function myQuestion(id){
    $('.questions').hide();
    $("#"+id).show();
    }

    function startTest(){
      
    }
  </script>