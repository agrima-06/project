@extends('layouts.theme2')

@section('title')
practiceQuestion
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
			</div>
			<div class="module-body table">								

				<table class="table table-message">
					<tbody>
						<tr class="heading">
							<td class="cell-title">Name</td>							
							<td class="d-flex justify-content-end">Status</td>
						</tr>	
						@foreach($practiceQuestions as $practiceQuestion)
						<tr class="task">
							<td class="cell-title"><div>{{$practiceQuestion->topic_id}}</div></td>
							<td class="cell-time align-right">
								<div class="d-flex flex-row bd-highlight d-flex justify-content-end">
								   <div class="p-2 bd-highlight">
								  	<form action="{{route('practiceQuestion.show',$practiceQuestion->id)}}" method="get">
									  @csrf
									  @method('PUT')
									  <button type="submit" class="btn btn-success btn-sm">view</button>
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
