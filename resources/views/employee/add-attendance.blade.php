@extends('layouts.master')
        @section('menu')
        @extends('sidebar.main-sidebar')
        @endsection
        @section('content')
            {{-- message --}}
            {!! Toastr::message() !!}

<div class="page-wrapper">
	<div class="content container-fluid">
	<div class="page-header">
	<div class="row align-items-center">
	<div class="col">
	<div class="mt-5">
	<h4 class="card-title float-left mt-2" >Add Attendance 
		<span id="date"></span>
		@if ($errors->any())
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif
	</h4>
	</div>
	</div>
	</div>
	</div>
	<div class="row">
	<div class="col-sm-12">
	<div class="card card-table">
	
	<div class="card-body">
	<div class="table-responsive">
		<form method="post" action="{{ route('form.Attendance.save') }}">

			@csrf
	<table class="table table-hover table-center mb-0">
	<thead>
	<tr>
	<th>#</th>
	<th>Employee Name</th>
	<th>Username</th>
	<th>Date Today</th>
	<th class="text-center">Actions</th>
	</tr>
	</thead>
	<tbody>
		@forelse ($employees as $index=>$employee)
		<tr>
		<td hidden class="id">{{ $employee->id }}</td>
		<td >{{ $index +1 }}</td>
		<td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
		<td>{{ $employee->username }}</td>
		<td>{{ date('l j F Y') }}</td>
		<td>
			<input hidden name="date" value="{{ date('j F Y') }}">
			<label class=" text-gray-500 font-semibold sm:border-r sm:pr-4">
				<input name="attendences[{{ $employee->id }}]" class="leading-tight" type="radio"
					   value="0">
				<span class="text-success">Attend</span>
			</label>

			<label class="ml-4 text-gray-500 font-semibold">
				<input name="attendences[{{ $employee->id }}]" class="leading-tight" type="radio"
					   value="1">
				<span class="text-danger">Absence</span>
			</label>
			
		</td>
		
		
	   
		
		@empty
		<tr colspan="6" rowspan="2" class="text-center">
		<td class="text-center" colspan="6" rowspan="2" class="text-center" >
			<div class="dropdown dropdown-action">	
				No Data Here 
			</div>
			</td>
		</tr>				
		@endforelse
	</tbody>
	</table>
	<P class="text-center mt-4 ">
		<button class="btn btn-success pl-4 pr-4 " type="submit">  Save  </button>
	</P>
</form><br>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	
	</div>
	
	</div>

	@endsection