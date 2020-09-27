
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
            Add Class
          </button>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Class</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="post" enctype="multipart/form-data" action= "{{route('class.store')}}" id="storeClass">
                    @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Add Class </label>
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="class">
                </div>
              </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                  <a type="button" class="btn btn-primary" onclick="storeClass.submit();">Submit</a>
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
              <td class="cell-title">Class</td>
              <td class="d-flex justify-content-end">Status</td>
            </tr> 
          @foreach($classes as $class)
           @if($class->approved == 0)
            <tr class="task">
              <td class="cell-title"><div>{{$class->class}} </div></td>
              <td class="cell-time align-right">
                <div class="d-flex flex-row bd-highlight  d-flex justify-content-end">
                   <div class="p-2 bd-highlight">
                    <form action="{{route('class.update',$class->id)}}" method="post">
                  @csrf
                  @method('PUT')
                  <button type="submit" class="btn btn-success btn-sm">Approve</button>
                  </form>
                  </div>
                  <div class="p-2 bd-highlight">                
                    <form action="{{route('class.destroy',$class->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                  </form>
                  </div>
                </div>
              </td>
            </tr>
            @endif
          @endforeach
          @foreach($classes as $class)
            @if($class->approved == 1)
            <tr class="task">
              <td class="cell-title"><div>{{$class->class}} </div></td>
              <td class="cell-time align-right">
                <div class="d-flex flex-row bd-highlight  d-flex justify-content-end">
                  <div class="p-2 bd-highlight">                
                    <form action="{{route('class.destroy',$class->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                  </form>
                  </div>
                </div>
              </td>
            </tr>
            @endif
          @endforeach
          </tbody>
        </table>

      </div>
      <div class="module-foot">
      </div>
    </div>
    
  </div><!--/.content-->
 						
@endsection
