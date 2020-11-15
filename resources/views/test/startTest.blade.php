<!DOCTYPE html>
<html>
   <head>
      <title>Page Title</title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <style>
         * {
         box-sizing: border-box;
         }
         /*html{
         width:100%;
         height:100%;
         }*/
         /* Style the body */
         html, body {
         position:fixed;
         top:0;
         bottom:0;
         left:0;
         right:0;
         /* */
         width:100%;
         height:100%;
         background-color:#DDD;
         font-family: Arial;
         margin: 0;
         }
         /* Header/logo Title */
         .subjects {
         padding: 10px;
         text-align: center;
         background: #1abc9c;
         color: blue;
         }
         .fill {object-fit: fill;}
         /* Style the top navigation bar */
         .questionList {
         display: flex;
         background-color: #333;
         }
         /* Style the navigation bar links */
         .questionList a {
         color: white;
         padding: 14px 20px;
         text-decoration: none;
         text-align: center;
         }
         /* Change color on hover */
         .questionList a:hover {
         background-color: #ddd;
         color: black;
         }
         /* Column container */
         .row1 {  
         display: flex;
         flex-wrap: wrap;
         }
         /* Create two unequal columns that sits next to each other */
         /* Sidebar/left column */
         .side {
         flex: 20%;
         background-color: #f1f1f1;
         padding: 5px;
         max-width: 350px;
         height: calc(100vh - 46.8px);
         }
         /* Main column */
         .main {
         flex: 80%;
         background-color: white;
         /*  padding: 20px;
         */}
         /* Fake image, just for this example */
         .fakeimg {
         background-color: #aaa;
         width: 100%;
         padding: 20px;
         }
         /* Footer */
         .submitAnswer {
         padding: 10px;
         text-align: center;
         background: #ddd;
         }
         .flex-container {
         display: flex;
         flex-wrap: wrap;
         /*  background-color: DodgerBlue;
         */}
         .flex-container > div {
         /*  background-color: #f1f1f1;
         */  width: 40px;
         margin: 2px;
         text-align: center;
         /*  line-height: 75px;
         */  font-size: 20px;
         }
         /* Responsive layout - when the screen is less than 700px wide, make the two columns stack on top of each other instead of next to each other */
         @media screen and (max-width: 768px) {
         .row1, .questionList {   
         flex-direction: column;
         }
         .mobileQlist{
         position: fixed;
         max-width: 80%;
         top:0;
         right:0;
         }
         }
      </style>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
      <link rel="stylesheet" href="{{asset('css/shapes.css')}}">
   </head>
   <body class="windowheight">
      <!-- Note -->
      <div class="logo" style="background:yellow;padding:5px">
         <div>
            <h4 style="text-align:center">Resize the browser window to see the responsive effect.</h4>
         </div>
         <div class="d-block d-md-none">
            <a  data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            <i class="fa fa-bars" style="font-size:36px; position:absolute; right: 0; top: 0; padding: 5px 20px 10px 10px;"></i>
            </a>
         </div>
      </div>
      <!-- Navigation Bar -->
      <!-- <div class="navbar" style="height: 100px;">
         </div> -->
      <!-- The flexible grid (content) -->
      <div class="row1">
         <div class="main">
            <!-- Header -->
            <div class="subjects border shadow p-1 bg-white rounded">
               <div>
                  @foreach($objectivetest->testquestions as $testsubject)
                  <button class="btn btn-primary" onclick="subjectQuestionList('{{$testsubject->id}}', '{{$testsubject->subject}}')">{{$testsubject->subject}}</button>
                  @endforeach
               </div>
               <div  class="questionList d-block d-md-none" style="height: 100px;">
                  <hr>
                  I m Questions List
               </div>
            </div>
            <div>
               <div id="questionNo">
                  Question No. <span id="currentQue"></span>
                  <hr>
               </div>
               <div id="questionOption" style="overflow-y: scroll">
                @foreach($objectivetest->testquestions as $testsubject)
                  <span style="display:no">{{$testsubject->subject}}</span>
                  @foreach($testsubject->questions() as $question)
                  <div class="questions" id="{{$testsubject->id}}{{$question->id}}" style="display:no">
                     {{$loop->iteration}} {{$question->question}} <br>
                     <div class="options form-check">
                        <input type="radio" id="optionA" name="option{{$testsubject->id}}{{$question->id}}" value="optionA">
                        <label for="optionA">{{$question->answer->optionA}}</label><br>
                        <input type="radio" id="optionB" name="option{{$testsubject->id}}{{$question->id}}" value="optionB">
                        <label for="optionB">{{$question->answer->optionB}}</label><br>
                        <input type="radio" id="optionC" name="option{{$testsubject->id}}{{$question->id}}" value="optionC">
                        <label for="optionC">{{$question->answer->optionC}}</label><br>
                        <input type="radio" id="optionD" name="option{{$testsubject->id}}{{$question->id}}" value="optionD">
                        <label for="optionD">{{$question->answer->optionD}}</label><br>
                     </div>
                  </div>
                  @endforeach
                  <br>
                  @endforeach
                  <hr>
               </div>
            </div>
            <!-- Footer -->
            <div class="submitAnswer d-flex bd-highlight mb-3">
              <div class="p-2 bd-highlight"><button class="btn btn-info">Marked for Review & Next</button></div>
              <div class="p-2 bd-highlight"><button class="btn btn-info">Clear Response</button></div>
              <div class="ml-auto p-2 bd-highlight"><button class="btn btn-info" id="saveNext" >Save & Next</button></div>
            </div>
         </div>
         <div class="side collapse d-flex flex-column"  id="collapseExample">
            <div class="userDetails card mb-1" style="max-width: 540px;">
               <div class="row no-gutters">
                  <div class="col-md-4">
                     <img src="{{asset('/image/profilepic/default.png')}}"  width="50" height="80" class="card-img" alt="...">
                  </div>
                  <div class="col-md-8">
                     <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                     </div>
                  </div>
               </div>
            </div>
            <div id="sideSumarry">
               <div class="answerSymbol instruction_area border shadow p-1 mb-1 bg-white rounded" style="font-size: 12px; overflow-y: scroll;" >
                  <table class="table table-borderless table-sm">
                     <tbody>
                        <tr>
                           <td class="p-0"><span class="answered">0</span><span>Answered</span></td>
                           <td class="p-0"><span class="not_answered">0</span>Not Answered</td>
                        </tr>
                        <tr>
                           <td class="p-0"><span class="not_visited">0</span>Not Visited</td>
                           <td class="p-0"><span class="review">0</span>Marked for Review </td>
                        </tr>
                        <tr>
                           <td class="p-0" colspan="2"><span class="review_marked">0</span>Answered & Marked for Review(will be considered for evaluation)</td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               <div class="border shadow p-1 bg-white rounded" id="questions">
                  <div class="selectedSubject p-2 mb-1 bg-info text-white text-center font-weight-bold"></div>
                  <hr class="m-0">
                  <div class="mb-1">Choose a question</div>
                @foreach($objectivetest->testquestions as $testsubject)
                  <div class="flex-container test {{$testsubject->id}}" style="overflow-y: scroll; height: 300px; display: none;">
                    @foreach($testsubject->questions() as $question)
                     <span class="not_visited Qno Qno{{$testsubject->id}}{{$question->id}}" onclick="myQuestion('{{$testsubject->id}}{{$question->id}}')">{{$loop->iteration}}</span>  
                    @endforeach                   
                  </div>
                @endforeach
               </div>
            </div>
            <div class="submitExam mt-3" style="background: #ddd; max-height: 100%" >
               <div class="d-flex justify-content-around">
                  <div><button class="btn btn-primary btn-sm">Question Paper</button></div>
                  <div><button class="btn btn-primary btn-sm">Instructions</button></div>
               </div>
               <div class=" d-flex justify-content-center mt-2"><button class="btn btn-primary" style="width: 100%; height: 100%" >Submit Exam</button></div>
            </div>
         </div>
      </div>
      <div class="recordedAnswer" style="display: none;">
         <form>
          @csrf
         <input type="text" name="answer[English][14]" value="A">
         <input type="text" name="answer[English][15]" value="B">
         <input type="text" name="answer[English][16]" value="">
         <input type="text" name="answer[GK][14]" value="B">       
         <input type="text" name="answer[GK][18]" value="D">
         <input type="text" name="array">  
        <button type="submit" class="btn btn-primary btn-sm mr-2">Submit</button>
        </form>
      </div>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
      <script type="text/javascript">
         var questions = $("#questions").html();
         $(".questionList").append(questions);
         
         $(window).resize(function(){
            if ($(window).width() <= 768) {
               console.log('mobile');
               $(".side").addClass("mobileQlist");
               $(".side").removeClass("show");
              // var questions = $("#questions").html();
               $(".questionList").css('display', '');
            } 
            else{
               $(".side").addClass("show");
               $(".questionList").css('display', 'none');
            } 
         });
         
         if($(window).width() <= 768){
           $(".side").addClass("mobileQlist");
           $(".questionList").css('display', '');
         }
         
         if($(window).width() >= 768){
           $(".side").addClass("show");
           $(".questionList").css('display', 'none');
         }
         
         $(document).on("click", function(event){
             if(!$(event.target).closest(".side").length && $(window).width() <= 768){
               console.log('trying');
               $(".side").removeClass("show");
             }
         });
         
           var w = window.innerWidth;
           var h = window.innerHeight;
         
           $('.windowheight').css('height',h);
         
         
         // This script for Main Content.
         //   var side = $('.side').height();
         //   $('.side').css('height', h-46.8)
         // console.log(side);
         
           var p = $('.logo').height();
           var q = $('.subjects').height();
           var r = $('.submitAnswer').height();
           var s = $('#questionNo').height();
         
           console.log(h);
           console.log(p);
           console.log(q);
           console.log(r);
         
           console.log(h - p - q - r);
           //var x = w - 46.8 - 
           //$('#questionOption').css('min-height', x);
          $('#questionOption').css('height', h - p - q - r-s-56);
          $('#sideSumarry').css('height', h - p - q - r-s-40);
         
         //Chane the Icon on click Question No, further Show the Question, It also Shows the Current Question No.
        function myQuestion(id){
         $('.questions').hide();
         $("#"+id).show();
         var currentQue =  $(".Qno"+id).html();
         $("#currentQue").html(currentQue);
          if ($(".Qno"+id).hasClass("not_visited")) {
            $(".Qno"+id).removeClass("not_visited");
            $(".Qno"+id).addClass("not_answered");
          }

         // var nextque = $(".Qno"+id).next('.Qno').html();
          var nextque = $(".Qno"+id).next('.Qno').attr('onclick');

          var nextque1= 'myAnswer(12,'+nextque+')';
          //console.log(nextque1);
          //console.log(nextque.param());
          //nextId = id+1;
          $("#saveNext").attr("onclick", nextque1);

         }

        function subjectQuestionList(subjectId, subjectName){
          console.log(subjectId+subjectName);
          $('.selectedSubject').html(subjectName);
          $('.test').css('display', 'none');
          $('.'+subjectId).css('display', '');
        }

        //Record the Answer on Save & Next
        function myAnswer(subject, Qid, value){
          console.log('called');
          // clearAnswer(subject, Qid);
          // var fieldHTML =  "<input type='text' name='answer["+subject+"]["+Qid+"]' value='"+value+"'>";
          // console.log(subject + Qid);
          // $('.answer').append(fieldHTML);
        }

        function saveNext(AnswerId, nextId){
          $("#saveNext").attr("onclick","new_function_name()");

        }





      </script>
        
   </body>
</html>