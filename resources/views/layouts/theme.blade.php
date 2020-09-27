<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="ha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        
        <!-- Make This Css In Seperate FIle in Final Website  -->
    <style type="text/css">
      
  .search {
  margin: 8px 0 0 15%;
}

.search #search_text_input {
  border: thin solid #E5E5E5;
    float: left;
    height: 23px;
    outline: 0;
    width: 100px;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    border-top-left-radius: 3px;
    border-bottom-left-radius: 3px;
}

.button_holder {
  background-color: #F1F1F1;
    border: thin solid #e5e5e5;
    cursor: pointer;
    float: left;
    height: 23px;
    text-align: center;
    width: 50px;
    border-top-right-radius: 3px;
    border-bottom-right-radius: 3px;
}

.button_holder img {
  margin-top: 1px;
    width: 20px;
}

.search_results {
  background-color: #fff;
    border: 1px solid #DADADA;
    border-bottom: none;
    border-top: none;
    margin-top: 21px;
}

.search_results_footer{
  padding: 7px 4px 0px 4px;
    height: 30px;
    border: 1px solid #DADADA;
    border-top: none;
    background-color: #20AAE5;
    text-align: center;
}

.search_results_footer a {
  color: #fff;
}

.search_result {
  padding: 10px;
    height: 100px;
}
    </style>  

    <style type="text/css">@yield('css')</style>  

    <title>@yield('title')</title>
  </head>
  <body style="background-color: #f3f7d3; color: #000">   

    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
      <a class="navbar-brand" href="{{route('welcome')}}" data-toggle="tooltip" data-placement="top" title="navbar">Navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item active">
            <a class="btn btn-light" href="{{route('home')}}" data-toggle="tooltip" data-placement="top" title="home">Home <span class="sr-only">(current)</span></a>
            <a class="btn btn-light" href="{{route('practiceQuestion.index')}}" data-toggle="tooltip" data-placement="top" title="home">practice Q</a>
          </li>
          <!-- <li class="nav-item active">
          @if(Auth::user()->role=="student")
            <a class="nav-link" href="{{route('student.index')}}">
            @elseif(Auth::user()->role=="teacher")
            <a class="nav-link" href="{{route('teacher.index')}}">
            @elseif(Auth::user()->role=="staff")
            <a class="nav-link" href="{{route('staff.home')}}">
            @elseif(Auth::user()->role=="admin")
            <a class="nav-link" href="{{route('admin.home')}}">
            @endif
              about me
            </a>
            </li> -->
          <li class="nav-item active">
            <a class="btn btn-light" href="{{route('homework.index')}}" data-toggle="tooltip" data-placement="top" title="homework">HomeWork</a>
          </li>

          <li class="nav-item active">
            <a class="btn btn-light" href="https://meet.google.com" data-toggle="tooltip" data-placement="top" title="Google Meet" target="new">Google Meet</a>
          </li>

          <li class="nav-item active">
            <a class="btn btn-light" href="https://translate.google.co.in/" data-toggle="tooltip" data-placement="top" title="dictionary">dictionary</a>
          </li>

          <li class="nav-item">
            <form action="{{route('logout')}}" method="POST">
            @csrf 
              <button type="submit" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="logout">logout</button>
            </form>
          </li> 
        </ul>

<!--     <div class="search">
      <form action="search.php" method="GET" name="search_form">
        <input type="text" onkeyup="getLiveSearch(this.value, '<?php echo "userLoggedIn"; ?>')" name="q" placeholder="Search..." autocomplete="off" id="search_text_input">
        <div class="button_holder">
          <img src="assets/img/icons/magnifying_glass.png">
        </div>
      </form>
      <div class="search_results">
      </div>
      <div class="search_results_footer_empty">
      </div>
    </div> -->

        


        <form class="form-inline my-2 my-lg-0" action="{{route('home.search')}}" method="Get">
          <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" value="{{request()->query('search')}}">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>

        <div class="btn-group dropleft">
            <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="{{asset('storage/'.auth()->user()->img)}}" style="border-radius: 50%;height: 35px;width: 35px;">
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <button class="btn btn-light" style="margin-left: 20px">
                @if(Auth::user()->role=="student")
                  <a class="nav-link" href="{{route('student.index')}}">
                  @elseif(Auth::user()->role=="teacher")
                  <a class="nav-link" href="{{route('teacher.index')}}">
                  @elseif(Auth::user()->role=="staff")
                  <a class="nav-link" href="{{route('staff.home')}}">
                  @elseif(Auth::user()->role=="admin")
                  <a class="nav-link" href="{{route('admin.home')}}">
                @endif
                  settings
                  </a>
              </button>        
              <a class="dropdown-item" href="#">
                <form action="{{route('logout')}}" method="POST">
                @csrf 
                  <button type="submit" class="btn btn-light" style="margin-left: 20px">logout</button>
                </form>
              </a>
            </div>
          </div> 
      </div>
    </nav>

    <div class="container-fluid p-0">
      <div class="d-flex justify-content-between" style="text-align: center;">
        <div class="col-2" style="background-color: #1a252f;">
          <img src="{{asset('storage/'.auth()->user()->img)}}" style="border-radius: 50%;height: 200px;width: 200px;margin-top: 25px">
                <div class="accordion" id="accordionExample" style="margin-top: 20%">

                  <div class="card-header p-0" data-toggle="collapse" data-target style="margin-top: 3%;background-color: #1a252f">
                      <h2 class="mb-0">
                        <button class="btn btn-link collapsed"  aria-expanded="true" aria-controls="collapseOne" style="color: #fff">
                         Hi!! {{Auth::user()->name}}
                        </button>
                      </h2>
                    </div>

 
                    <div style="background-color: #1a252f">
                    <div class="card-header p-0" id="headingFour" data-toggle="collapse" data-target="#collapseFour" style="margin-top: 3%;">
                      <h2 class="mb-0">
                        <button class="btn btn-link collapsed"  aria-expanded="true" aria-controls="collapseFour" style="color: #fff">
                        @if(Auth::user()->role == 'teacher') 
                         My Students
                        
                        @elseif(Auth::user()->role == 'student')
                        My Subjects

                        @endif
                        </button>
                      </h2>
                    </div> 

                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                      <div class="card-body" >
                          <ul class="navbar-nav mr-auto mt-2 mt-lg-0" >
                          
                          @if(Auth::user()->role == 'teacher')
                              @foreach(Auth::user()->teacher->schoolTeacherRelations as $relation)
                              <li class="nav-item" style="margin-bottom: 10px;color: #fff">
                                <a href="{{route('myClass.student', $relation->sclass->id)}}" style="color: #fff">
                                  {{$relation->sclass->class}}{{$relation->section->section}}
                                </a>
                              </li>
                            @endforeach
                          
                          @elseif(Auth::user()->role == 'student') 
                            @foreach(Auth::user()->student->relations() as $relation)
                              <li class="nav-item" style="margin-bottom: 10px;color: #fff">
                                <a href="{{route('myClass.teacher', $relation->subject->id)}}" style="color: #fff">
                                  {{$relation->subject->name}}
                                </a>
                              </li>
                            @endforeach
                          
                          @endif
                          
                          </ul>              
                      </div>
                    </div>
                  </div>

                  <div style="background-color: #1a252f">
                    <div class="card-header p-0" id="headingOne" data-toggle="collapse" data-target="#collapseOne" style="margin-top: 3%;">
                      <h2 class="mb-0">
                        <button class="btn btn-link collapsed"  aria-expanded="true" aria-controls="collapseOne" style="color: #fff">
                         homework
                        </button> 
                      </h2>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                      <div class="card-body" >
                          
                          <ul class="navbar-nav mr-auto mt-2 mt-lg-0" >
                          
                          @if(Auth::user()->role == 'student') 
                            @foreach(Auth::user()->student->relations() as $relation)
                              <li class="nav-item" style="margin-bottom: 10px;color: #fff">
                                <a href="{{route('student.homework', $relation->subject->id)}}">
                                  {{$relation->subject->name}}
                                </a>
                              </li>
                            @endforeach
                          
                          @endif
                          
                          </ul>              
                      </div>
                    </div>
                  </div>

                  <div style="background-color: #1a252f" >
                    <div class="card-header p-0" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" style="margin-top: 3%">
                      <h2 class="mb-0">
                        <button class="btn btn-link collapsed"  aria-expanded="false" aria-controls="collapseTwo" style="color: #fff">
                          library
                        </button>
                      </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                      <div class="card-body">
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0" >
                          <li class="nav-item" style="margin-top: 5px;color: #fff">
                            syllabus
                          </li>
                          <li class="nav-item" style="margin-top: 25px;color: #fff">
                            previous year question papers
                          </li>
                          <li class="nav-item" style="margin-top: 25px;color: #fff">
                            downloads
                          </li>
                          </ul> 
                      </div>
                    </div>
                  </div>

                  <div style="background-color: #1a252f ">
                    <div class="card-header p-0" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" style="margin-top: 3%">
                      <h2 class="mb-0">
                        <button class="btn btn-link collapsed" aria-controls="collapseThree" style="color: #fff">
                          Discussion
                        </button>
                      </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                      <div class="card-body">
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0" >
                          <li class="nav-item" style="margin-top: 5px;color: #fff">
                            Ask from teacher
                          </li>
                          <li class="nav-item" style="margin-top: 25px;color: #fff">
                            Ask publicially
                          </li>
                          <li class="nav-item" style="margin-top: 25px;color: #fff">
                            Ask from friends
                          </li>
                          </ul> 
                      </div>
                    </div>
                  </div>


                  <div style="background-color: #1a252f ">
                    <div class="card-header p-0" id="headingFour" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" style="margin-top: 3%">
                      <h2 class="mb-0">
                        <button class="btn btn-link collapsed" aria-controls="collapseFour" style="color: #fff">
                         Practice Questions
                        </button>
                      </h2>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                      <div class="card-body">
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0" >
                          @if(Auth::user()->role == 'student') 
                            @foreach(Auth::user()->student->relations() as $relation)
                              <li class="nav-item" style="margin-bottom: 10px;color: #fff">
                                <a href="{{route('student.practiceQuestion', $relation->subject->id)}}">
                                  {{$relation->subject->name}}
                                </a>
                              </li>
                            @endforeach                          
                          @endif 
                      </div>
                    </div>
                  </div>



                </div>
              </div>

     <div class="col-7">
      @yield('body')
      </div>

      <div class="col-3">
        
        ad portion
      </div>
    </div>
    </div>

    <section class="py-4 text-center text-white" style="background-color: #1a252f;padding: 265px">
            <div class="container-fluid  bg-secondary rounded">
                <h5 style="text-align: center;">About me:</h5><p>
                Hello Everyone, I am Agrima Kesharwani, a student of class 9 standard, from a small place in Chhattisgarh, who is having passionate interest in programming. I am learning computer programming from my elder Brother and implementing my skills by developing this website. This website is to make our education system online with all facilities. I will be keep update new features. Thanks everyone!!</p>
            </div>
        </section>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $('#search_text_input').focus(function() {
    if(window.matchMedia( "(min-width: 800px)" ).matches) {
      $(this).animate({width: '250px'}, 500);
    }
  });

  $('.button_holder').on('click', function() {
    document.search_form.submit();
  })



  $(document).click(function(e){

  if(e.target.class != "search_results" && e.target.id != "search_text_input") {

    $(".search_results").html("");
    $('.search_results_footer').html("");
    $('.search_results_footer').toggleClass("search_results_footer_empty");
    $('.search_results_footer').toggleClass("search_results_footer");
  }

  if(e.target.className != "dropdown_data_window") {

    $(".dropdown_data_window").html("");
    $(".dropdown_data_window").css({"padding" : "0px", "height" : "0px"});
  }


});

  function getLiveSearch(value, user) {

  $.post("includes/handlers/ajax_search.php", {query:value, userLoggedIn: user}, function(data) {

    if($(".search_results_footer_empty")[0]) {
      $(".search_results_footer_empty").toggleClass("search_results_footer");
      $(".search_results_footer_empty").toggleClass("search_results_footer_empty");
    }

    $('.search_results').html(data);
    $('.search_results_footer').html("<a href='search.php?q=" + value + "'>See All Results</a>");

    if(data == "") {
      $('.search_results_footer').html("");
      $('.search_results_footer').toggleClass("search_results_footer_empty");
      $('.search_results_footer').toggleClass("search_results_footer");
    }

  });

}
    </script>
          @yield('script')

  </body>
</html>