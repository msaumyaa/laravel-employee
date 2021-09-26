@extends('layouts.app')
@section('content')
<div class="card card-default">
	<div class="card-header">{{ isset($companies) ? 'Edit Company' : 'Create Company' }}</div>
	<div class="card-body">
    @include('partial.errors')
    <form action="{{ isset($companies) ? route('companies.update',$companies->id) : route('companies.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    @if(isset($companies))
        @method('PUT')
    @endif
			<div class="form-group">
                <label for="name">Name</label>
				<input type="text" name="name" id="name" class="form-control" placeholder="John Doe.." value="{{ isset($companies) ? $companies->name : '' }}">
			</div>
			<div class="form-group">
                <label for="name">Email</label>
				<input type="email" name="email" id="email" class="form-control" placeholder="Johndoe@gmail.com" value="{{ isset($companies) ? $companies->email : '' }}">
			</div>
            <div class="form-group">
                <label for="name">Website</label>
				<input type="text" name="website" id="website" class="form-control" placeholder="www.whatever.com" value="{{ isset($companies) ? $companies->website : '' }}">
			</div>
            <div class="form-group">
                <label for="name">Logo</label>
				<input type="file" name="file" id="file" class="form-control" >
                @if(isset($companies->logo)) 
                <img id="logo" src="{{ asset('storage/'.$companies->logo) }}" height="80px" width="80px" />
                @else
                <img id="logo" src="{{ asset('storage/noimage.png') }}" height="80px" width="80px" />
                @endif
			</div>
            <div class="form-group">
				<button type="submit" name="file" id="file" class="btn btn-primary">{{ isset($companies) ? 'Update' : 'Save' }}</button>
			</div>
		</form>
    </div>
</div>

@endsection