@extends('layouts.theme2')

@section('title')
about me
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
					  Add School
					</button>

					<!-- Modal -->
					<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Add School</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
					        <form method="post" enctype="multipart/form-data" action= "{{route('school.store')}}" id="storeSchool">
					        	@csrf
							  <div class="form-group">
							    <label for="exampleInputEmail1">Add School's Name </label>
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
							<td class="cell-icon"></td>
							<td class="cell-title">Name</td>
							<td class="cell-status hidden-phone hidden-tablet">Address</td>
							<td class="cell-time align-right">Affiliated</td>
							<td class="cell-time align-right">Status</td>
						</tr>	
						@foreach($schools as $school)
							@if($school->approved == 0)
						<tr class="task">
							<td class="cell-icon"><i class="icon-checker high"></i></td>
							<td class="cell-title"><div><a href="{{route('school.show', $school->id)}}">{{$school->name}}</a></div></td>
							<td class="cell-status hidden-phone hidden-tablet"><b class="due">{{$school->address}}, {{$school->city}}, {{$school->state}}</b></td>
							<td class="cell-time align-right">{{$school->affilated_to}}</td>
							<td class="cell-time align-right">
								<div class="d-flex flex-row bd-highlight mb-3">
								   <div class="p-2 bd-highlight">
								  	<form action="{{route('school.update',$school->id)}}" method="post">
									@csrf
									@method('PUT')
									<button type="submit" class="btn btn-success btn-sm">Approve</button>
									</form>
								  </div>
								  <div class="p-2 bd-highlight">								
								  	<form action="{{route('school.destroy',$school->id)}}" method="post">
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
					@foreach($schools as $school)
						@if($school->approved == 1)
						<tr class="task resolved">
							<td class="cell-icon"><i class="icon-checker high"></i></td>
							<td class="cell-title"><div><a href="{{route('school.show', $school->id)}}">{{$school->name}}</a></div></td>
							<td class="cell-status hidden-phone hidden-tablet">{{$school->address}}, {{$school->city}}, {{$school->state}}</td>
							<td class="cell-time align-right">{{$school->affilated_to}}</td>
							<td class="cell-time align-right">
								<form action="{{route('school.destroy', $school->id)}}" method="post">
									@csrf
									@method('DELETE')
								<button type="submit" class="btn btn-danger btn-sm">Delete</button>
								</form>
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
