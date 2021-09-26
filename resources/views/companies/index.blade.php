@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-end mb-2">
	<a href="{{ route('companies.create') }}" class="btn btn-success">Add Company</a>	
</div>
<div class="card card-default">
	<div class="card-header">Companies</div>
	<div class="card-body">
		@if($companies->count()>0) 
		<table class="table">
			<thead>
				<th>Image</th>
				<th>Title</th>
				<th>Email</th>
				<th>Website</th>
				<th>Action</th>
			</thead>
			<tbody>

				@foreach($companies as $company)
				<tr>
				 	<td><img src="{{ (isset($company->logo) && $company->logo!='') ? asset('storage/'.$company->logo) : asset('storage/noimage.png') }}" HEIGHT="50px" WIDTH="50px"> </td>
				 	<td>
						{{ $company->name }}
					</td>
					<td>
						{{ $company->email }}
					</td>
					<td>				 		
						{{ $company->website }}
				 	</td>
					 <td>				 		
						<a href="{{ route('companies.edit',$company->id) }}">Edit</a>
						<a onclick="handleDelete({{ $company->id }},'companies')" href="javascript:void(0)">Delete</a>
				 	</td>		 	
				</tr>

				@endforeach
			</tbody>
		@else
			<h3 class="text-center">No Companies Yet!</h3>
		@endif
			
		</table>
		
	</div>
</div>
<div style="float:right;">
{{$companies->links()}}
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
