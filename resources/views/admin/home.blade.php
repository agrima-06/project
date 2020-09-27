@extends('layouts.theme2')

@section('title')
Home Admin 
@endsection

@section('content')

          <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>

              <!-- Content Row -->
            <div class="row">
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                  <a href="{{route('school.index')}}">
                  <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Schools</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">
                             @if(count($schools) > 0) {{count($schools)}} @endif <b>+</b>
                          </div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                  </a> 
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                  <a href="{{route('teacher.index')}}">
                  <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Teachers</div> 
                          <div class="h5 mb-0 font-weight-bold text-gray-800">
                            @if(count($teachers) > 0) {{count($teachers)}} @endif <b>+</b>
                          </div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                  </a>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                  <a href="#">
                  <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Students</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">@if(count($students) > 0) {{count($students)}} @endif <b>+</b></div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                  </a>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                  <a href="{{(route('subject.index'))}}">
                  <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"> subject</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                  </a>
                </div>                
              </div>

            <div class="row">
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                  <a href="{{(route('homework.index'))}}">
                  <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Homework</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">
                              @if(count($homeworks) > 0) {{count($homeworks)}} @endif<b>+</b>     
                          </div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                  </a>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                  <a href="{{(route('practiceQuestion.index'))}}">
                  <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-success text-uppercase mb-1"> Practice Questions</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">
                            @if(count($practiceQuestions) > 0) {{count($practiceQuestions)}} @endif <b>+</b>
                          </div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                  </a>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">          
                  <a href="{{route('class.index')}}">
                  <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Class</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                  </a>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                  <a href="{{route('section.index')}}">
                  <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Section</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                  </a>
                </div>                
              </div>

           <!-- Content Row -->

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
 						
@endsection
