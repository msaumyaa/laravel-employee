@extends('layouts.app')
@section('content')
<div class="card card-default">
	<div class="card-header">
		{{ isset($employee) ? 'Edit employee' : 'Create employee' }}
	</div>
	<div class="card-body">
		@if($errors->any())
		 <div class="alert alert-danger">
		 	<ul class="list-group">
		 		@foreach($errors->all() as $error)
		 			<li class="list-group-item text-danger"> {{ $error }} </li>
		 		@endforeach
		 	</ul>
		 </div>
		@endif
		<form action="{{ isset($employee) ? route('employee.update',$employee->id) : route('employee.store') }}" method="post" enctype="multipart/form-data">
			@csrf
			@if(isset($employee))
				@method('PUT')
			@endif
			<div class="form-group">
				<label for="title">First Name</label>
				<input type="text" class="form-control" id="fname" name="fname" value="{{ isset($employee) ? $employee->fname : '' }}">
			</div>
			<div class="form-group">
				<label for="title">Last Name</label>
				<input type="text" class="form-control" id="lname" name="lname" value="{{ isset($employee) ? $employee->lname : '' }}">
			</div>
						
			<div class="form-group">
				<label for="category">Company</label>
				<select name="company_id" id="company_id" class="form-control">
					@foreach($companies as $company)
						<option value="{{ $company->id }}"
							@if(isset($employee))
							@if($company->id==$employee->company_id)
								selected
							@endif
							@endif
							>{{ $company->name }}</option>
					@endforeach
					
				</select>
			</div>
			<div class="form-group">
				<label for="title">Email</label>
				<input type="email" class="form-control" id="email" name="email" value="{{ isset($employee) ? $employee->email : '' }}">
			</div>
			<div class="form-group">
				<label for="title">Phone</label>
				<input type="number" class="form-control" id="phone" name="phone" value="{{ isset($employee) ? $employee->phone : '' }}">
			</div>
			
			<div class="form-group">
				<button type="submit" class="btn btn-success">{{ isset($employee) ? 'Update employee' : 'Add employee' }}</button>	
			</div>
		</form>
	</div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script>
flatpickr("#published_at",{
	enableTime:true,
	enableSeconds:true
});

$(document).ready(function() {
    $('.tags-selector').select2();
});
</script>
@endsection

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
@endsection