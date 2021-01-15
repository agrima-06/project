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
         }*/f
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
         height: 100%;
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
      <div class="logo row" style="background:#DCF2F1;padding:5px">
         <div class="col-10 col-md-12" style="text-align: center;">
            Created by:-
            @if($objectivetest->promotion == 1)
              @if(isset($objectivetest->promotions->logo))
                  {{$objectivetest->promotions->logo}}
              @else

              @endif
              <strong>{{$objectivetest->promotions->brandName}}</strong>&nbsp;&nbsp;
              {{$objectivetest->promotions->Address}} &nbsp;&nbsp;
              <a href="tel:{{$objectivetest->promotions->contactNo}}">{{$objectivetest->promotions->contactNo}}</a>
              &nbsp;&nbsp;
              <a class="btn btn-light btn-sm" href="{{$objectivetest->promotions->website}}" target="_blank">Website</a>
            @else
               The Test has been Created by User:
            @endif
         </div>
         <div class="d-block col-1 mr-2 d-md-none mobileMenu" >
            <a  data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" style="font-size:36px;">
            <i class="fa fa-bars"  ></i>
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
               <div class="d-flex">
                  <div class="p-1 bd-highlight">
                     @foreach($objectivetest->testquestions as $testsubject)
                     <!--                      <button class="btn btn-primary" id="subjectName{{$testsubject->id}}" onclick="subjectQuestionList('{{$testsubject->id}}', '{{$testsubject->subject}}')">{{$testsubject->subject}}
                        <span class="badge badge-light tooltip_{{$testsubject->id}}">4</span>
                        </button> -->
                     <div class="btn-group">
                        <button  class="btn btn-primary btn-sm subjectSelectButton" id="subjectName{{$testsubject->id}}" onclick="subjectQuestionList('{{$testsubject->id}}', '{{$testsubject->subject}}')">{{$testsubject->subject}}
                        </button>
                        <button type="button" class="btn btn-primary subjectStatus{{$testsubject->id}} dropdown-toggle dropdown dropdown-toggle-split" data-toggle="dropdown" data-target="#d1{{$testsubject->id}}" aria-haspopup="true" aria-expanded="false" onmouseover="subjectStatusHover({{$testsubject->id}})" onmouseleave="subjectStatusHoverOut({{$testsubject->id}})">
                        <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu instruction_area" id="d{{$testsubject->id}}" style="font-size:13px; width: 220px;">
                           <a class="dropdown-item p-0"><span class="answered ansstatus{{$testsubject->id}}"></span>Answered</a>
                           <a class="dropdown-item p-0"><span class="not_answered not_ansstatus{{$testsubject->id}}"></span>Not Answered</a>
                           <a class="dropdown-item p-0"><span class="not_visited not_visstatus{{$testsubject->id}}"></span>Not Visited</a>
                           <a class="dropdown-item p-0"><span class="review revstatus{{$testsubject->id}}"></span>Marked for Review</a>
                           <a class="dropdown-item p-0"><span class="review_marked revmstatus{{$testsubject->id}}"></span>Answered & Marked for Review</a>
                        </div>
                     </div>
                     <input type="hidden" name="subject{{$testsubject->id}}" value="{{$testsubject->subject}}">
                     @endforeach
                  </div>
                  <div class="ml-auto p-2 bd-highlight">
                     <span>Left: </span><span class="time rounded p-2 bg-secondary text-white">Time</span>
                  </div>
                  <div class="ml-auto p-2" id="updateMarks">
                     marks: <span id="subjectMarks"></span>
                  </div>
               </div>
               <div  class="questionList d-block d-md-none" style="max-height: 100px; overflow-y: auto; overflow-x:hidden">
               </div>
            </div>
            <div>
               <div class="d-flex bd-highlight" id="questionNo">
                  <div class="p-2 flex-grow-1 bd-highlight">Question No. <span id="currentQue"></span></div>
                  <div class="p-2 bd-highlight">
                     <label for="examlanguage">Language:</label>
                     <select name="examlanguage" id="examlanguage"  onchange="changelanguage(this.value)">
                        <option value="English">English</option>
                        <option value="Hindi" selected>Hindi</option>
                     </select>
                  </div>
                  <div class="p-2 bd-highlight" id="reportQuestion">
                     <button class="btn btn-danger btn-sm">Report</button>
                  </div>
               </div>
               <hr class="m-0 p-0">
               <div id="questionOption" style="overflow-y: auto; overflow-x:hidden;">
                  <?php  
                     $newCount = "0";
                     $QueNo = "0";
                     ?>
                  @foreach($objectivetest->testquestions as $testsubject)
                  <span style="display:none">{{$testsubject->subject}}</span>
                  @foreach($testsubject->questions() as $question)
                  @if($question->type == 'objective')
                  @php
                  $newCount = $newCount + 1
                  @endphp
                  <div class="questions englishView english{{$testsubject->id}}_{{$question->id}}" id="Qno{{$testsubject->id}}_{{$question->id}}" style="display:none">
                     {{$newCount}}) {{$question->question}}  <br>
                     <div class="options form-check">
                        <input type="radio" id="optionA{{$testsubject->id}}_{{$question->id}}" name="option{{$testsubject->id}}_{{$question->id}}" value="A">
                        <label for="optionA{{$testsubject->id}}_{{$question->id}}">{{$question->answer->optionA}}</label><br>
                        <input type="radio" id="optionB{{$testsubject->id}}_{{$question->id}}" name="option{{$testsubject->id}}_{{$question->id}}" value="B">
                        <label for="optionB{{$testsubject->id}}_{{$question->id}}">{{$question->answer->optionB}}</label><br>
                        <input type="radio" id="optionC{{$testsubject->id}}_{{$question->id}}" name="option{{$testsubject->id}}_{{$question->id}}" value="C">
                        <label for="optionC{{$testsubject->id}}_{{$question->id}}">{{$question->answer->optionC}}</label><br>
                        <input type="radio" id="optionD{{$testsubject->id}}_{{$question->id}}" name="option{{$testsubject->id}}_{{$question->id}}" value="D">
                        <label for="optionD{{$testsubject->id}}_{{$question->id}}">{{$question->answer->optionD}}</label>
                     </div>
                     <button class="testStart" onclick="onLoadlocalStorag()">TEST BUTTON </button>
                     <hr class="queBreakLine" style="display: none;">
                  </div>
                  @if(isset($question->hversion)) 
                  <div class="questions hindiView hindi{{$testsubject->id}}_{{$question->id}}" id="Qno{{$testsubject->id}}_{{$question->id}}" style="display:none">
                     {{$newCount}}) {{$question->hversion->question}}  <br>
                     <div class="options form-check">
                        <input type="radio" id="optionA{{$testsubject->id}}_{{$question->id}}" name="option{{$testsubject->id}}_{{$question->id}}" value="A">
                        <label for="optionA{{$testsubject->id}}_{{$question->id}}">{{$question->hversion->answer->optionA}}</label><br>
                        <input type="radio" id="optionB{{$testsubject->id}}_{{$question->id}}" name="option{{$testsubject->id}}_{{$question->id}}" value="B">
                        <label for="optionB{{$testsubject->id}}_{{$question->id}}">{{$question->hversion->answer->optionB}}</label><br>
                        <input type="radio" id="optionC{{$testsubject->id}}_{{$question->id}}" name="option{{$testsubject->id}}_{{$question->id}}" value="C">
                        <label for="optionC{{$testsubject->id}}_{{$question->id}}">{{$question->hversion->answer->optionC}}</label><br>
                        <input type="radio" id="optionD{{$testsubject->id}}_{{$question->id}}" name="option{{$testsubject->id}}_{{$question->id}}" value="D">
                        <label for="optionD{{$testsubject->id}}_{{$question->id}}">{{$question->hversion->answer->optionD}}</label>
                     </div>
                     <button class="testStart" onclick="onLoadlocalStorag()">TEST BUTTON </button>
                     <hr class="queBreakLine" style="display: none;">
                  </div>
                  @endif
                  @endif
                  @endforeach
                  @foreach($testsubject->questions() as $question)
                  @if($question->type == 'comprehensive')
                  @php
                  $newCount = $newCount + 1
                  @endphp
                  <div class="questions englishView english{{$testsubject->id}}_{{$question->id}} row" id="Qno{{$testsubject->id}}_{{$question->id}}" style="display:none">
                     <div class="col-md-6 bg-light">
                        {{$question->comprehensive->content}}
                     </div>
                     <div class="col-md-6">
                        {{$newCount}}) {{$question->question}} 
                        <br>
                        <div class="options form-check">
                           <input type="radio" id="optionA{{$testsubject->id}}_{{$question->id}}" name="option{{$testsubject->id}}_{{$question->id}}" value="A">
                           <label for="optionA{{$testsubject->id}}_{{$question->id}}">{{$question->answer->optionA}}</label><br>
                           <input type="radio" id="optionB{{$testsubject->id}}_{{$question->id}}" name="option{{$testsubject->id}}_{{$question->id}}" value="B">
                           <label for="optionB{{$testsubject->id}}_{{$question->id}}">{{$question->answer->optionB}}</label><br>
                           <input type="radio" id="optionC{{$testsubject->id}}_{{$question->id}}" name="option{{$testsubject->id}}_{{$question->id}}" value="C">
                           <label for="optionC{{$testsubject->id}}_{{$question->id}}">{{$question->answer->optionC}}</label><br>
                           <input type="radio" id="optionD{{$testsubject->id}}_{{$question->id}}" name="option{{$testsubject->id}}_{{$question->id}}" value="D">
                           <label for="optionD{{$testsubject->id}}_{{$question->id}}">{{$question->answer->optionD}}</label><br>
                        </div>
                        <button class="testStart" onclick="onLoadlocalStorag()">TEST BUTTON </button>
                        <hr class="queBreakLine" style="display: none;">
                     </div>
                  </div>
                  @if(isset($question->hversion)) 
                  <div class="questions hindiView hindi{{$testsubject->id}}_{{$question->id}}" id="Qno{{$testsubject->id}}_{{$question->id}}" style="display:none">
                     <div class="col-md-6 bg-light">
                        {{$question->hversion->comprehensive->content}}
                     </div>
                     <div class="col-md-6">
                        {{$newCount}}) {{$question->hversion->question}} 
                        <br>
                        <div class="options form-check">
                           <input type="radio" id="optionA{{$testsubject->id}}_{{$question->id}}" name="option{{$testsubject->id}}_{{$question->id}}" value="A">
                           <label for="optionA{{$testsubject->id}}_{{$question->id}}">{{$question->hversion->answer->optionA}}</label><br>
                           <input type="radio" id="optionB{{$testsubject->id}}_{{$question->id}}" name="option{{$testsubject->id}}_{{$question->id}}" value="B">
                           <label for="optionB{{$testsubject->id}}_{{$question->id}}">{{$question->hversion->answer->optionB}}</label><br>
                           <input type="radio" id="optionC{{$testsubject->id}}_{{$question->id}}" name="option{{$testsubject->id}}_{{$question->id}}" value="C">
                           <label for="optionC{{$testsubject->id}}_{{$question->id}}">{{$question->hversion->answer->optionC}}</label><br>
                           <input type="radio" id="optionD{{$testsubject->id}}_{{$question->id}}" name="option{{$testsubject->id}}_{{$question->id}}" value="D">
                           <label for="optionD{{$testsubject->id}}_{{$question->id}}">{{$question->hversion->answer->optionD}}</label><br>
                        </div>
                        <button class="testStart" onclick="onLoadlocalStorag()">TEST BUTTON </button>
                        <hr class="queBreakLine" style="display: none;">
                     </div>
                  </div>
                  @endif
                  @endif
                  @endforeach
                  @endforeach
                  <hr>
               </div>
            </div>

            <!-- Instructions Modal -->
            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog" style="max-width:100%">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">General Instructions:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body modal-dialog modal-dialog-scrollable" style="max-width:100%">
            <div class="instructionEnglish">
               <ol style="text-align: left; padding-top: 3px; padding-left: 4%; list-style-type: decimal;">  
                  <li>Total duration of examination is <strong>60 </strong>minutes. (20 minutes extra for every 60 minutes (1 hour) of the examination time for candidates with disability eligible for compensatory time).</li>  
                  <li>The clock will be set at the server. The countdown timer in the top right corner of screen will display the remaining time available for you to complete the examination. When the timer reaches zero, the examination will end by itself. You will not be required to end or submit your examination.</li>  
                  <li>The Question Palette displayed on the right side of screen will show the status of each question using one of the following symbols:  
                     <table class="instruction_area" style="FONT-SIZE: 100%">  
                        <tbody>  <tr>  <td><span class="not_visited" title="Not Visited">1</span></td>  <td>You have not visited the question yet.</td>  </tr>  <tr>  <td><span class="not_answered" title="Not Answered">2</span></td>  <td>You have not answered the question.</td>  </tr>  <tr>  <td><span class="answered" title="Answered">3</span></td>  <td>You have answered the question.</td>  </tr>  <tr>  <td><span class="review" title="Marked for Review">4</span></td>  <td>You have NOT answered the question, but have marked the question for review.</td>  </tr>  <tr>  <td><span class="review_marked" title="Answered &amp; Marked for Review">5</span></td>  <td>The question(s) "Answered and Marked for Review" will be considered for evaluation.</td>  </tr>  
                        </tbody>  
                     </table>  
                  </li>  
                  <li style="list-style-type: none;">The Marked for Review status for a question simply indicates that you would like to look at that question again. <font color="red"><i>If a question is answered and Marked for Review, your answer for that question will be considered in the evaluation. </i></font></li>  
                  <li style="list-style-type: none;"> </li> 
                </ol> 

               <p><strong><u>Navigating to a Question: </u></strong></p> 
               <ol>  
                  <li value="4">To answer a question, do the following:  
                     <ol style="list-style-type: lower-alpha;">  
                        <li>Click on the question number in the Question Palette at the right of your screen to go to that numbered question directly. Note that using this option does NOT save your answer to the current question.</li>  
                        <li>Click on <strong>Save &amp;Next</strong> to save your answer for the current question and then go to the next question.</li>  
                        <li>Click on <strong>Mark for Review &amp; Next</strong> to save your answer for the current question, mark it for review, and then go to the next question.</li>  
                     </ol>  
                  </li> 
               </ol>  
               <p><strong><u>Answering a Question : </u></strong></p>  
               <ol>  <li value="5">Procedure for answering a multiple choice type question:</li> </ol> 
               <ol style="margin-left: 40px; list-style-type: lower-alpha;">  
                  <li>To select your answer, click on the button of one of the options</li>  
                  <li>To deselect your chosen answer, click on the button of the chosen option again or click on the <strong>Clear Response</strong> button</li>  
                  <li>To change your chosen answer, click on the button of another option</li>  
                  <li>To save your answer, you MUST click on the <strong>Save &amp; Next</strong> button</li>  
                  <li>To mark the question for review, click on the <strong>Mark for Review &amp; Next</strong> button. <em>If an answer is selected for a question that is Marked for Review, that answer will be considered in the evaluation. </em></li> 
               </ol> 
               <ol>  
                  <li value="6">To change your answer to a question that has already been answered, first select that question for answering and then follow the procedure for answering that type of question.</li>  
                  <li>Note that ONLY Questions for which answers are saved or marked for review after answering will be considered for evaluation.</li> 
               </ol>  
               <p><strong><u>Navigating through sections: </u></strong></p> 
               <ol>  
                  <li value="8">Sections in this question paper are displayed on the top bar of the screen. Questions in a section can be viewed by clicking on the section name. The section you are currently viewing is highlighted.</li>  
                  <li>You can shuffle between tests and questions anytime during the examination as per your convenience only during the time stipulated</li>  
                  <li>Candidate can view the corresponding section summary as part of the legend that appears in every section above the question palette.<span> </span><span> </span></li> 
               </ol>
            </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Footer -->
            <div class="submitAnswer d-flex" style="background-color: #DCF2F1; position: fixed; bottom: 0; width: 80%;">
               <div class="p-2"><button class="btn btn-info" id="markedforReview">Marked for Review & Next</button></div>
               <div class="p-2"><button class="btn btn-info" id="clearResponse">Clear Response</button></div>
               <div class="ml-auto p-2"><button class="btn btn-info" id="saveNext" >Save & Next</button></div>
            </div>
         </div>
         <div class="side collapse"  id="collapseExample">
            <div class="d-flex flex-column" id="symbolQueList">
               <div class="userDetails card mb-1" style="max-width: 540px;">
                  <div class="row no-gutters">
                     <div class="col-4">
                        <img src="{{asset('/image/profilepic/default.png')}}"  width="50" height="80" class="card-img" alt="...">
                     </div>
                     <div class="col-8">
                        <div class="card-body">
                           <h5 class="card-title">Card title</h5>
                        </div>
                     </div>
                  </div>
               </div>
               <div id="sideSumarry">
                  <div class="selectedSubject mobileSelectedSubject p-2 mb-1 bg-info text-white text-center font-weight-bold" style="display: none;"></div>
                  <div class="answerSymbol instruction_area border shadow p-1 mb-1 bg-white rounded" style="font-size: 12px; overflow-y: auto;" >
                     <table class="table table-borderless table-sm">
                        <tbody>
                           <tr>
                              <td class="p-0"><span class="answered ansstatus"></span><span>Answered</span></td>
                              <td class="p-0"><span class="not_answered not_ansstatus"></span>Not Answered</td>
                           </tr>
                           <tr>
                              <td class="p-0"><span class="not_visited not_visstatus"></span>Not Visited</td>
                              <td class="p-0"><span class="review revstatus"></span>Marked for Review </td>
                           </tr>
                           <tr>
                              <td class="p-0" colspan="2"><span class="review_marked revmstatus"></span>Answered & Marked for Review(will be considered for evaluation)</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
                  <div class="border shadow p-1 bg-white rounded" id="questions">
                     <div class="selectedSubject p-2 mb-1 bg-info text-white text-center font-weight-bold"></div>
                     <hr class="m-0">
                     <div class="mb-1">Choose a question</div>
                     <div id="questionNoList">
                        @foreach($objectivetest->testquestions as $testsubject)
                        <div class="flex-container test {{$testsubject->id}}"  style="overflow-y: auto; max-height: 270px; display: none;">
                           @foreach($testsubject->questions() as $question)
                           @if($question->type == 'objective')
                           @php
                           $QueNo = $QueNo + 1
                           @endphp
                           <span class="not_visited Qno Qno{{$testsubject->id}}_{{$question->id}}" id="{{$testsubject->id}}_{{$question->id}}" onclick="myQuestion('{{$testsubject->id}}_{{$question->id}}')">{{$QueNo}}</span>
                           @endif  
                           @endforeach 
                           @foreach($testsubject->questions() as $question)
                           @if($question->type == 'comprehensive')
                           @php
                           $QueNo = $QueNo + 1
                           @endphp
                           <span class="not_visited Qno Qno{{$testsubject->id}}_{{$question->id}}" id="{{$testsubject->id}}_{{$question->id}}" onclick="myQuestion('{{$testsubject->id}}_{{$question->id}}')">{{$QueNo}}</span>
                           @endif  
                           @endforeach                   
                        </div>
                        @endforeach
                     </div>
                  </div>
               </div>
            </div>

            <div class="submitCompletePaper" style="position: fixed; bottom: 0; width: 20%;">
               <div class="submitExam d-flex justify-content-around" >
                  <div><button class="btn btn-primary btn-sm" onclick="viewQuestionPaper()">Question Paper</button></div>
                  <div><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">Instructions</button></div>
               </div>
               <div class="mt-1 mb-1"><button class="btn btn-primary" style="width: 100%;"  onclick="submitPaper()">Submit Exam</button>
               </div>
            </div>
         </div>
      </div>
      <form action="{{route('test.submit.answer')}}" id="submitPaper" method="get">
         <div class="recordedAnswer" style="display: none;">
            @csrf
               <input type="text" name="user_id" value="12451">
               <input type="text" name="test_id" value="19">

            <!--          <input type="text" name="answer[English][14]" value="A">
               <input type="text" name="answer[English][15]" value="B">
               <input type="text" name="answer[English][16]" value="">
               <input type="text" name="answer[GK][14]" value="B">       
               <input type="text" name="answer[GK][18]" value="D">
               <input type="text" name="array">  
               <button type="submit" class="btn btn-primary btn-sm mr-2">Submit</button> -->
         </div>
      </form>
      <!--    <div class='answerSymbol instruction_area border shadow p-1 mb-1 bg-white rounded' style='font-size: 12px; overflow-y: scroll;' >
         <table class='table table-borderless table-sm'>
            <tbody>
               <tr>
                  <td class='p-0'><span class='answered'>0</span><span>Answered</span></td>
               </tr>
               <tr>
                  <td class='p-0'><span class='not_answere'>0</span>Not Answered</td>
               </tr>
               <tr>
                  <td class='p-0'><span class='not_visited'>0</span>Not Visited</td>
               </tr>
               <tr>
                  <td class='p-0'><span class='review'>0</span>Marked for Review </td>
               </tr>
               <tr>
                  <td class='p-0'><span class='review_marked'>0</span>Answered & Marked for Review(will be considered for evaluation)</td>
               </tr>
            </tbody>
         </table>
         </div> -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
      <script type="text/javascript">

         
         window.currentQueId = 0;
         window.previousQueId = 0;
         window.answered = 10;
         window.not_visited = 0;
         window.not_answered = 0;
         // window.markedforReview = 0;
         window.answered_markedforReview = 0;
         window.examlanguage = $('#examlanguage').val();
         
         //Subject wise variable for Answer Status and Marking Scheme
         @foreach($objectivetest->testquestions as $testsubject)
            window.subjectMark{{$testsubject->id}} = '+{{$testsubject->marks}}, -{{$testsubject->negativeMarks}}';
         @endforeach        
                  
         function updateAnswerStatus(id){
            var numItems = $('.'+id).children('span.not_visited').length;
            var numItems1 = $('.'+id).children('span.not_answered').length;
            var numItems2 = $('.'+id).children('span.answered').length;
            var numItems3 = $('.'+id).children('span.review_marked').length;
            var numItems4 = $('.'+id).children('span.review').length;
            $('.ansstatus').html(numItems2);
            $('.not_ansstatus').html(numItems1);
            $('.not_visstatus').html(numItems);
            $('.revstatus').html(numItems4);
            $('.revmstatus').html(numItems3);
         }
         
         window.numItems777 = updateVariables();
                  
         function updateVariables(){
            window.numItems777 = $('.31').children('span.not_visited').length;
            return window.numItems777;
         }
                  
         function changelanguage(value){
            window.examlanguage = value;
            myQuestion(window.currentQueId);
          }
         
         function subjectStatusHover(id){
            $('#d'+id).addClass('show');
            updateAnswerStatus1(id); 
          }
         
         function subjectStatusHoverOut(id){
            $('#d'+id).removeClass('show'); 
          }
         
         function updateAnswerStatus1(id){
            var numItems = $('.'+id).children('span.not_visited').length;
            var numItems1 = $('.'+id).children('span.not_answered').length;
            var numItems2 = $('.'+id).children('span.answered').length;
            var numItems3 = $('.'+id).children('span.review_marked').length;
            var numItems4 = $('.'+id).children('span.review').length;
            $('.ansstatus'+id).html(numItems2);
            $('.not_ansstatus'+id).html(numItems1);
            $('.not_visstatus'+id).html(numItems);
            $('.revstatus'+id).html(numItems4);
            $('.revmstatus'+id).html(numItems3);
         }       

         function mobileQuestionList(subjectId){
            var questions = $("."+subjectId).html();
            $(".questionList").html(questions);
         }  
         
         // $('.queBreakLine').css();

         function viewQuestionPaper(){
            $('.queBreakLine').show();

            if(examlanguage == 'Hindi'){
               $('.hindiView').show(); //if No hindi Question Display English
            }
            else if(examlanguage == 'English'){
               $('.englishView').show();
            }
         }      

         function shortenSubjectButton(){
            @foreach($objectivetest->testquestions as $testsubject)
              var subjectName{{$testsubject->id}} = $("#subjectName{{$testsubject->id}}").html();
              $("#subjectName{{$testsubject->id}}").html(cutString(subjectName{{$testsubject->id}}, 0, 3)+'..');
            @endforeach
            $('#markedforReview').addClass('btn-sm').css('font-size', '12px');
            $('#clearResponse').addClass('btn-sm').css('font-size', '12px');
            $('#saveNext').addClass('btn-sm').css('font-size', '12px');
            $('.submitAnswer').addClass('p-0');
            $('#updateMarks').hide();
            $('#reportQuestion').hide();
            $('.submitCompletePaper').css({'position':'', 'bottom': '', 'width': ''});
            $('.mobileSelectedSubject').show();
            questionOptionsHeight();
         }
         
         function normalSubjectButton(){
            @foreach($objectivetest->testquestions as $testsubject)
              var subjectName{{$testsubject->id}} = '{{$testsubject->subject}}';
              $("#subjectName{{$testsubject->id}}").html(subjectName{{$testsubject->id}});
            @endforeach
            $('#markedforReview').removeClass('btn-sm').css('font-size', '');
            $('#clearResponse').removeClass('btn-sm').css('font-size', '');
            $('#saveNext').removeClass('btn-sm').css('font-size', '');
            $('.submitAnswer').removeClass('p-0');
            $('#updateMarks').show();
            $('#reportQuestion').show();
            $('.submitCompletePaper').css({'position':'fixed', 'bottom': '0', 'width': '20%'});
            $('.mobileSelectedSubject').hide();
            questionOptionsHeight();
         }
         
         function cutString(str, from, character) {
            var res = str.substring(from, character);
            return res;
         }

         function questionOptionsHeight(){
            var h = window.innerHeight;
            var p = $('.logo').height();//Height of Promotion Logo in window panel.
            var q = $('.subjects').height();//Height of timer/subjects in main bar.
            var r = $('.submitAnswer').height(); //Height of save/marked/next in main bar.
            var s = $('#questionNo').height(); //Height of change in laguage section in main bar.
            $('#questionOption').css('max-height', h - p - q - r - s - 56);
         }

         function sidebarQuestionHeight(){
            if ($(window).height() <= 550){
               $('.answerSymbol').css('max-height', '60px');
            }
            else{
               $('.answerSymbol').css('max-height', '');
            }
            var h = window.innerHeight;
            var p = $('.logo').height();//Height of Promotion Logo in window panel.
            var q = $('.subjects').height();//Height of timer/subjects in main bar.
            var r = $('.submitAnswer').height(); //Height of save/marked/next in main bar.
            var s = $('#questionNo').height(); //Height of change in laguage section in main bar.
            var t = $('.userDetails').height(); //Height of user Image in side bar.
            var u = $('.answerSymbol').height(); //Height of Instruction Symbols in side bar
            var v = $('.submitCompletePaper').height(); //Height of Submit paper/Instruction in side bar
            var m = $('.side').height();
            $('.test').css('max-height', h - t - u - v-165);
            var mon = h - t - u - v-165;
            console.log('resize'+ mon);
         }
         
         $(window).resize(function(){
           //Mobile View Reached
            if ($(window).width() <= 768) {
               $(".side").addClass("mobileQlist");
               $(".side").removeClass("show");
              // var questions = $("#questions").html();
               $(".questionList").css('display', '');
               $(".submitAnswer").css('width', '100%');
               //$(".submitExam").css('width', '80%');
               $("#questions").css('display', 'none');
               $('.dropdown').hide();
               shortenSubjectButton();
            } 
           //Large View Reached
           else{
               $(".side").addClass("show");
            // $(".side").removeClass("mobileQlist");
               $(".submitAnswer").css('width', '80%');
               $(".submitExam").css('width', '100%');
               $(".questionList").css('display', 'none');
               $("#questions").css('display', '');
               $('.dropdown').show();
               normalSubjectButton();
               sidebarQuestionHeight();
           } 
         });         
         
         //Mobile View
         if($(window).width() <= 768){
            $(".side").addClass("mobileQlist");
            $(".questionList").css('display', '');
            $(".submitAnswer").css('width', '100%');
          //   $(".submitExam").css('width', '80%');
             //$(".submitExam").css('position', '');
            $("#questions").css('display', 'none');
            $(".side").addClass('mobileQlist');
            $('.dropdown').hide();
            shortenSubjectButton();
         }        
         
         //Large Screen
         if($(window).width() >= 768){
            $(".side").addClass("show");
            $(".questionList").css('display', 'none');
            sidebarQuestionHeight();
         }
         
         $(document).on("click", function(event){
            if(!$(event.target).closest(".side").length && $(window).width() <= 768 && !$(event.target).closest(".mobileMenu").length){
              console.log('trying');
              $(".side").removeClass("show");
             // $(".side").removeClass("mobileQlist");
            }
         });        
         
         // This script for Main Content.
         //   var side = $('.side').height();
         //   $('.side').css('height', h-46.8)
          var w = window.innerWidth;
          var h = window.innerHeight;         
          $('.windowheight').css('height',h);          
          var p = $('.logo').height();//Height of Promotion Logo in window panel.
          var q = $('.subjects').height();//Height of timer/subjects in main bar.
          var r = $('.submitAnswer').height(); //Height of save/marked/next in main bar.
          var s = $('#questionNo').height(); //Height of change in laguage section in main bar.       
          //$('#questionOption').css('min-height', x);
         //$('#questionOption').css('height', h - p - q - r-s-56);
            $('#questionOption').css('max-height', h - p - q - r - s - 56);

         //Chane the Icon on click Question No, further Show the Question, It also Shows the Current Question No.
         function myQuestion(id){         
            window.previousQueId = window.currentQueId;
            window.currentQueId = id;                                   
            $(".Qno"+window.previousQueId).removeClass("selected");            
            $(".Qno"+window.currentQueId).addClass("selected");
            unCheckRadio(window.previousQueId);
            $('.questions').hide();
            //$("#Qno"+id).show();
            if(examlanguage == 'Hindi'){
               if($('.hindi'+id).length == 0) {
                  $('.english'+id).show(); //if No hindi Question Display English
               }
               else {
                  $('.hindi'+id).show();
               }
            }
            else if(examlanguage == 'English'){
               $('.english'+id).show();
            }
         
            var currentQue =  $(".Qno"+id).html();
            $("#currentQue").html(currentQue);
            if ($(".Qno"+id).hasClass("not_visited")) {        
              $(".Qno"+id).removeClass("not_visited");              
              $(".Qno"+id).addClass("not_answered");
              storeLocalStorage(id, 'none', 'not_answered');
            }
            var saveNext= 'saveNext("'+window.currentQueId+'")';
            $("#saveNext").attr("onclick", saveNext);
            var clearResponse= 'clearResponse("'+window.currentQueId+'")';
            $("#clearResponse").attr("onclick", clearResponse);
            var markedforReview = 'markedforReview("'+window.currentQueId+'")';
            $("#markedforReview").attr("onclick", markedforReview); 
            //This will give subject Id
            var idSubject = id.split("_");
            //This will Just update Symbol status 
            updateAnswerStatus(idSubject[0]);     
         }
         
         function subjectQuestionList(subjectId, subjectName){
            $('.questions').hide();
            $('.subjectSelectButton').removeClass('active');
            $('#subjectName'+subjectId).addClass('active');
            console.log(subjectId+subjectName);
            var updateMarks = eval('subjectMark'+subjectId); //  var myVar = eval(varString);
            updateAnswerStatus(subjectId);        
            $('#subjectMarks').html(updateMarks);
            $('.selectedSubject').html(subjectName);
            $('.test').css('display', 'none');
            $('.'+subjectId).css('display', '');
            mobileQuestionList(subjectId);
         }
         
         //Record the Answer on Save & Next
         function saveNext(id){
            var subject = selectedSubject(id) ;        
            var value = $("input:radio[name=option"+id+"]:checked").val();
            if (typeof value !== 'undefined') {              
               $(".Qno"+id).removeClass("not_answered");   
               $(".Qno"+id).removeClass("review");        
               $(".Qno"+id).removeClass("review_marked");
               $("#Qno"+id).addClass("answered");
               $(".Qno"+id).addClass("answered");
               recordingAnswer(subject, id , 'answered'); 
               var idSubject = id.split("_");
               //this will update symbols
               updateAnswerStatus(idSubject[0]);            
            }         
            //Moving to Next Que
            nextQuestion(id) ;     
         }
         
         function selectedSubject(id){
         var idBreak = id.split("_");
         console.log(idBreak[0]);
         var subject = $('input[name =subject'+idBreak[0]+']').val();
         return subject;
         }
         
         function recordingAnswer(subject, id, type){
               var idSubject = id.split("_");
               //this will update symbols
            //   updateAnswerStatus(idSubject[0]);   
         $(".recordedAnswer").find("input[name ='answer["+idSubject[0]+"_sub]["+idSubject[1]+"]']").remove();
         // console.log(xyz);
         var value = $("input:radio[name=option"+id+"]:checked").val();
         
         var fieldHTML =  "<input type='text' name='answer["+idSubject[0]+"_sub]["+idSubject[1]+"]' value='"+value+"'>";
         $('.recordedAnswer').append(fieldHTML);
         storeLocalStorage(id, value, type);
         }
         //THIS IS NOT WORKING
         function nextQuestion(id){
            console.log(".Qnsso"+id);
            // var nextque = $(".Qno"+id).next('.Qno');         
            var nextque = $(".Qno"+id).next('.Qno').attr('id');
            console.log(nextque);
            if (typeof nextque !== 'undefined') {
               myQuestion(nextque);
             }
             // else{

             //   var idBreak = id.split("_");
             // //  console.log(idBreak[0]);
             //   var nextque = $("."+idBreak[0]).next("div").attr('class');
             //   console.log(nextque);
             // }
             //Make else Condition and find the Id of Next Subject if Next Subject Exists then Select the first question of the next subject.   
         }
         
         // function saveNext(AnswerId, nextId){
         //   $("#saveNext").attr("onclick","new_function_name()");
         // }
         
         
         //if Not Saved Uncheck Selected Radio
         function unCheckRadio(id){
            if ($("#Qno"+id).hasClass("answered")) {
             // console.log('answered');
            }
            else{
              //console.log('Not Answereanswered');
              $( "input[type='radio'][name='option"+id+"']" ).prop( "checked", false);
            }
         }
         
         function clearResponse(id){
            var subject = selectedSubject(id) ;        
            $("#Qno"+id).removeClass("answered");
            $( "input[type='radio'][name='option"+id+"']" ).prop( "checked", false);
            $(".Qno"+id).removeClass("answered");
            $(".Qno"+id).removeClass("not_visited");
            $(".Qno"+id).removeClass("review_marked");
            $(".Qno"+id).removeClass("review");            
            $(".Qno"+id).removeClass("answered");
            $(".Qno"+id).addClass("not_answered");
            var idSubject = id.split("_");
            $(".recordedAnswer").find("input[name ='answer["+idSubject[0]+"_sub]["+idSubject[1]+"]']").remove();
            storeLocalStorage(id, 'none', 'visited');         
            //This will give subject Id
            //console.log(idSubject[0]);
            //This is for updating current status
            //   window['not_visited'+idSubject[0]] =  window['not_visited'+idSubject[0]] - 1;
            //   window['not_answered'+idSubject[0]] =  window['not_answered'+idSubject[0]] + 1;
            updateAnswerStatus(idSubject[0]);    
         }
         
         
         function markedforReview(id){
            //  console.log(id+'jhfgsdjf');
            var subject = selectedSubject(id) ;  
            var idSubject = id.split("_");
      
            var value = $("input:radio[name=option"+id+"]:checked").val();
            if (typeof value !== 'undefined') {
               $(".Qno"+id).removeClass("not_answered");
               $(".Qno"+id).removeClass("not_visited");
               $(".Qno"+id).removeClass("review");
               $(".Qno"+id).removeClass("not_visited");            
               $(".Qno"+id).removeClass("answered");
               $("#Qno"+id).addClass("answered");
               $(".Qno"+id).addClass("review_marked");
               recordingAnswer(subject, id, 'review_marked');         
                              //This will give subject Id
               //var idSubject = id.split("_");         
               updateAnswerStatus(idSubject[0]);    
            }
            else {
               $(".Qno"+id).removeClass("not_answered");
               $(".Qno"+id).removeClass("not_visited");
               $(".Qno"+id).removeClass("review_marked");
               $(".Qno"+id).removeClass("not_visited");            
               $(".Qno"+id).removeClass("answered");
               $("#Qno"+id).addClass("answered"); //This appears to be incorrect.. 
               $(".Qno"+id).addClass("review");
               storeLocalStorage(id, 'none', 'review');         
            }
            // Saving Answer
            var fieldHTML =  "<input type='text' name ='answer["+idSubject[0]+"_sub]["+idSubject[1]+"]' value='"+value+"'>";
            $('.recordedAnswer').append(fieldHTML);
            //console.log(fieldHTML);
            //Moving to Next Que
            nextQuestion(id) ;
            //This will give subject Id
          //  var idSubject = id.split("_");         
            updateAnswerStatus(idSubject[0]);    
         }
         
         function answered(id){
            $(".Qno"+id).removeClass("not_answered");
            $(".Qno"+id).removeClass("not_visited");
            //console.log(".Qno"+id);         
            $(".Qno"+id).addClass("answered");
         }
         
         function submitPaper(){
            //console.log('agaa');
            $("#submitPaper").submit();
         }
         
         function storeLocalStorage(id, answer, type){
            if(localStorage.hasOwnProperty("answers")){
               var answers = removeLocalStorage(id);
               var newAnswer = {
                                "id": id,
                                "answer": answer,
                                "answerType": type
                              };
               answers.push(newAnswer);
               localStorage.setItem("answers", JSON.stringify(answers));
              //console.log(answers);
            }
            else{         
               var answers = [
                            {
                            "id": id,
                            "answer": answer,
                            "answerType": type
                            },
                          ];
              //console.log(answers);
               localStorage.setItem("answers", JSON.stringify(answers));
            }
         }
         
         function removeLocalStorage(id){
            var answers = JSON.parse(localStorage.getItem("answers")); 
            for(var i=0;i<answers.length;i++){
               if(answers[i].id==id){
                  answers.splice(i, 1);
               }
            }
            return answers;
         }     
         
         function onLoadlocalStorage() {
                        var idSubject = id.split("_");

         if(typeof(Storage) !== "undefined") {
           //now Check For get localStorage
           localStorage.timecount = 50;
           if(localStorage.hasOwnProperty("answers")){
             if(localStorage.timecount>10){
               var answers = JSON.parse(localStorage.getItem("answers"));
               console.log(answers);
               for(var i=0;i<answers.length;i++){
                 var id = answers[i].id;
                 var answer = answers[i].answer;        
                 $(".Qno"+id).removeClass("not_visited");
                 if(answers[i].answerType=='not_answered'){
                     $(".Qno"+id).addClass("not_answered");
                 }
                 if(answers[i].answerType=='answered'){
                     $(".Qno"+id).addClass("answered");
                     $("#option"+answer+id).prop("checked", true);
                     $("#Qno"+id).addClass('answered');
                     var subject = selectedSubject(id);
                     var fieldHTML =  "<input type='text' name ='answer["+idSubject[0]+"_sub]["+idSubject[1]+"]' value='"+answer+"'>";
                     $('.recordedAnswer').append(fieldHTML);
                 }
                 if(answers[i].answerType=='review_marked'){
                     $(".Qno"+id).addClass("review_marked");
                     $("#option"+answer+id).prop("checked", true);
                     $("#Qno"+id).addClass('answered');
                     var subject = selectedSubject(id);
                     var fieldHTML =  "<input type='text' name ='answer["+idSubject[0]+"_sub]["+idSubject[1]+"]'>";
                     $('.recordedAnswer').append(fieldHTML);
                 }
                 if(answers[i].answerType=='review'){
                   $(".Qno"+id).addClass("review");
                 }
               }
             }
             else{
               //Ask about Previous Test. 
               console.log("Freshly Logiined");            
             }
           }
           else{
             //Freshly Load the Test 
             console.log("Freshly Logiined");        
           }
           // if (localStorage.timecount) {
           //   localStorage.timecount = Number(localStorage.timecount)+1;
           //   if($("#amount").val()!=0){
           //     var principal = $("#amount").val();        
           //   }
           //   else{
           //     var principal = JSON.parse(localStorage.getItem("testKey")).principalAmount;
           //   }
           //   if($("#interest").val()!=0){
           //     var interest = $("#interest").val();
           //   }
           //   else{
           //     var interest = JSON.parse(localStorage.getItem("testKey")).interestAmount;
           //   }
           //   if($("#period").val()!=0){
           //     var years = $("#period").val();
           //   }
           //   else{
           //     var years = JSON.parse(localStorage.getItem("testKey")).Period;
           //   }            
         
           //   localStorage.setItem("testKey", JSON.stringify({"principalAmount": principal, "interestAmount": interest, "Period": years }));
           //   var test = JSON.parse(localStorage.getItem("testKey"));               
             
           //    // var item = [];
           //    //item.push(principal,interest,years);
           //   // localStorage.item += JSON.stringify({ "principalAmount": principal, "interestAmount": interest, "Period": years }); 
           // } 
           // else {
           //   localStorage.timecount = 1;
           // }
           // document.getElementById("result").innerHTML = "You have clicked the button " + localStorage.timecount + principal+ test.principalAmount+" time(s).";
         } 
         
         else {
         
           //This should say that the Browser Does not support the Test. 
           document.getElementById("result").innerHTML = "Sorry, your browser does not support web storage...";
         }
         }
         
         function twoDigit(number, targetLength) {
           var output = number + '';
           while (output.length < targetLength) {
               output = '0' + output;
           }
           return output;
         }
         
         var sec = {{$objectivetest->duration}}*60;
         var myVar = "";
         //  $('.time').html(sec);
         $('.testStart').on('click', function(){    
         window.myVar = setInterval(myTimer, 1000);

         function myTimer() {      
           if(sec==0){
             clearTimeout(myVar);
             submitPaper();         
           }
           else{
             sec = sec-1;
             //var hour = sec/3600;
             var hour = twoDigit(Math.floor(sec/3600), 2);
                           // 01
            // var hour = ('0'+Math.floor(sec/3600)).slice(-2);
         
            var min = twoDigit(Math.floor((sec%3600)/60), 2);
            // var min = ('0'+Math.floor((sec%3600)/60)).slice(-2);
             var secs = twoDigit((sec%3600)%60, 2);
             //var secs = ('0'+(sec%3600)%60).slice(-2);
         
             $('.time').html(hour+' : '+min+' : '+secs);
           }
         }
         // $('time').html()
         });
         
         $('.pause').on('click', function(){  
         //console.log(window.myVar);
            clearTimeout(window.myVar);
          // $('time').html()
         });
      </script>
   </body>
</html>