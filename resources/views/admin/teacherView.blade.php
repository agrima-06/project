
@extends('layouts.theme2')

@section('title')
Home Admin 
@endsection

@section('content')

  <div class="content">

    <div class="module message">
      <div class="module-head">
        <h3>Task Management Tool</h3>
      </div>
      <div class="module-option clearfix">
        <div class="pull-left">
          Filter : &nbsp;
          <div class="btn-group">
            <button class="btn">All</button>
            <button class="btn dropdown-toggle" data-toggle="dropdown">
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <li><a href="#">All</a></li>
              <li><a href="#">In Progress</a></li>
              <li><a href="#">Done</a></li>
              <li class="divider"></li>
              <li><a href="#">New task</a></li>
              <li><a href="#">Overdue Task</a></li>
            </ul>
          </div>
        </div>
        <div class="pull-right">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary float-right mb-2" data-toggle="modal" data-target="#exampleModal">
            Add Teacher
          </button>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Teacher</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="post" enctype="multipart/form-data" action= "{{route('school.store')}}" id="storeSchool">
                    @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Add Teacher's Name </label>
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Country</label>
                  <input type="text" class="form-control" name="country" id="exampleInputPassword1">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">State</label>
                  <input type="text" class="form-control" name="state" id="exampleInputPassword1">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">City</label>
                  <input type="text" class="form-control" name="city" id="exampleInputPassword1">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Address</label>
                  <input type="text" class="form-control" name="address" id="exampleInputPassword1">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Affilated to</label>
                  <input type="text" class="form-control" name="affilated_to" id="exampleInputPassword1">
                </div>
              </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                  <a type="button" class="btn btn-primary" onclick="storeSchool.submit();">Submit</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="module-body table">               

        <table class="table table-message">
          <tbody>
            <tr class="heading">
              <td class="cell-title">Name</td>
              <td class="d-flex justify-content-end">Status</td>
            </tr> 
            @foreach($teachers as $teacher)
            <tr class="task">
              <td class="cell-title"><div>{{$teacher->user->name}} </div></td>
              <td class="cell-time align-right">
                <div class="d-flex flex-row bd-highlight  d-flex justify-content-end">
                   <div class="p-2 bd-highlight">
                    <form action="{{route('school.update',$teacher->id)}}" method="post">
                  @csrf
                  @method('PUT')
                  <button type="submit" class="btn btn-success btn-sm">Approve</button>
                  </form>
                  </div>
                  <div class="p-2 bd-highlight">                
                    <form action="{{route('school.destroy',$teacher->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                  </form>
                  </div>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
      <div class="module-foot">
      </div>
    </div>
    
  </div><!--/.content-->
 						
@endsection
