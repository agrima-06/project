
@extends('layouts.theme')

@section('title')
Home
@endsection

@section('body')


      <form>
        @csrf
       <input type="text" name="answer[English][14]" value="A">
       <input type="text" name="answer[English][15]" value="B">
       <input type="text" name="answer[English][16]" value="">
       <input type="text" name="answer[GK][14]" value="B">       
       <input type="text" name="answer[GK][18]" value="D">
       <input type="text" name="array">

        <!-- <input type="text" name="section_id" value='1'>
        <input type="text" name="subject_id" value='1'>
        <input type="text" name="teacher_id" value='1'>
        <input type="text" name="classteacher" value='1'> -->
<!--    <input type="text" name="subject_id">

 -->     
        <button type="submit" class="btn btn-primary btn-sm mr-2">Submit</button>


      </form>

      <br><br>
        <button  class="btn btn-primary btn-sm mr-2" onclick="myAnswer('English', '14')">CLICK ME ID ENGLISH 14</button>
        <button class="btn btn-primary btn-sm mr-2" onclick="myAnswer('English', '15')">CLICK ME ID ENGLISH 15</button>
        <button class="btn btn-primary btn-sm mr-2" onclick="myAnswer('English', '16')">CLICK ME ID ENGLISH 16</button>
        <button class="btn btn-primary btn-sm mr-2" onclick="myAnswer('GK', '14')">CLICK ME ID GK 14</button>
        <button class="btn btn-primary btn-sm mr-2" onclick="clearAnswer('GK', '14')">CLEAR GK 14</button>

        ANSWERS
        <form action="{{route('test.submit.answer')}}" method="get">
          <div class="answer">
          </div>
                  <button type="submit" class="btn btn-primary btn-sm mr-2">Submit</button>

        </form> 

        Q.1 AJDAJDH AKSBHA  ADKJADH ?<br>
          <input type="radio" id="A15" name="answer15" onclick="myAnswer('English', '15', 'A')" >
          <label for="A15">Option A</label><br>
          <input type="radio" id="B15" name="answer15" onclick="myAnswer('English', '15', 'B')">
          <label for="B15">Option B</label><br>
          <input type="radio" id="C15" name="answer15" onclick="myAnswer('English', '15', 'C')">
          <label for="C15">Option C</label>  <br> 
          <input type="radio" id="D15" name="answer15" onclick="myAnswer('English', '15', 'D')">
          <label for="D15">Option D</label> <br>
          <input type="radio" id="E15" name="answer15" onclick="myAnswer('English', '15', 'E')">
          <label for="E15">Option E</label> <br>
        <button class="btn btn-primary btn-sm mr-2" onclick="clearAnswer('English', '15')">CLEAR</button><br>

        Q.2 AJDAJDH AKSBHA  ADKJADH ?<br>
          <input type="radio" id="A16" name="answer16" onclick="myAnswer('English', '16', 'A')" >
          <label for="A16">Option A</label><br>
          <input type="radio" id="B16" name="answer16" onclick="myAnswer('English', '16', 'B')">
          <label for="B16">Option B</label><br>
          <input type="radio" id="C16" name="answer16" onclick="myAnswer('English', '16', 'C')">
          <label for="C16">Option C</label>  <br> 
          <input type="radio" id="D16" name="answer16" onclick="myAnswer('English', '16', 'D')">
          <label for="D16">Option D</label> <br>
          <input type="radio" id="E16" name="answer16" onclick="myAnswer('English', '16', 'E')">
          <label for="E16">Option E</label> <br>
        <button class="btn btn-primary btn-sm mr-2" onclick="clearAnswer('English', '16')">CLEAR</button><br>

@endsection

@section('script')
<script type="text/javascript">
    console.log('AHA');

function myAnswer(subject, Qid, value){
    clearAnswer(subject, Qid);
    var fieldHTML =  "<input type='text' name='answer["+subject+"]["+Qid+"]' value='"+value+"'>";
    console.log(subject + Qid);
    $('.answer').append(fieldHTML);
}

function clearAnswer(subject, Qid){
    //$(this).prop('checked', false);
   // $("[name='answer16']").prop("checked", false);


    $("[name='answer["+Qid+"]']").prop("checked", false);

   element = $("[name='answer["+subject+"]["+Qid+"]']"); 
   element.remove(); 
}
</script>

@endsection
