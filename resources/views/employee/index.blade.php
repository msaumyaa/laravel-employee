@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-end mb-2">
	<a href="{{ route('employee.create') }}" class="btn btn-success">Add Employee</a>	
</div>
<div class="card card-default">
	<div class="card-header">Employee</div>
	<div class="card-body">
		@if($employees->count()>0)
		<table class="table">
			<thead>
				<th>Name</th>
				<th>Company</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Action</th>
			</thead>
			<tbody>

				@foreach($employees as $employee)
				<tr>
				 	<td>{{$employee->fname.' '.$employee->lname}}</td>
				 	<td>
				 		
				 			@if(isset($employee->company_id))
				 			<a href="{{ route('employee.edit',$employee->company_id)}}">{{ $employee->company->name }}</a>
				 			@else
				 			{{ '--' }}
				 			@endif
				 		
				 	</td>
					<td>{{$employee->email}}</td>
				 	<td>{{$employee->phone}}</td>
				 	
					<td>		 		
						<a href="{{ route('employee.edit',$employee->id) }}">Edit</a>
						<a onclick="handleDelete({{ $employee->id }},'employee')" href="javascript:void(0)">Delete</a>
				 	</td>				 	
				</tr>

				@endforeach
			</tbody>
		@else
			<h3 class="text-center">No Employees Yet!</h3>
		@endif
		
		</table>
	</div>
</div>
<div style="float:right;">
{{$employees->links()}}
</div>
<!-- Modal -->
		<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <form action="" method="POST" id="deleteForm">
		    	@csrf
		    	@method('DELETE')
		    	<div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Are you sure ?</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <p class="text-center text-bold">Are you sure you want to delete this company?</p>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go Back</button>
			        <button type="submit" class="btn btn-danger">Yes, Delete</button>
			      </div>
			    </div>
		    </form>
		  </div>
		</div>
@endsection