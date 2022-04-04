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
	<h4 class="card-title float-left mt-2" >Attendance 
		
	</h4>
	<a href="{{route('form.Attendance.add')}}" class="btn btn-primary float-right veiwbutton">Add
		Attendance</a>
	</div>
	</div>
	</div>
	</div>
	<div class="row">
	<div class="col-sm-12">
	<div class="card card-table">
	
	<div class="card-body">
	<div class="table-responsive">
		<form method="post" action="">

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

			@if(isset($employee->attendance()->where('attendence_date',date('Y-m-d'))->first()->employee_id))

				<label class=" text-gray-500 font-semibold sm:border-r sm:pr-4">
					<input name="attendences[{{ $employee->id }}]" disabled
						   {{ $employee->attendance()->first()->attendence_status == 1 ? 'checked' : '' }}
						   class="leading-tight" type="radio" value="presence">
					<span class="text-success">Attend</span>
				</label>

				<label class="ml-4  text-gray-500 font-semibold">
					<input name="attendences[{{ $employee->id }}]" disabled
						   {{ $employee->attendance()->first()->attendence_status == 0 ? 'checked' : '' }}
						   class="leading-tight" type="radio" value="absent">
					<span class="text-danger">Absence</span>
				</label>

			@else

				<label class=" text-gray-500 font-semibold sm:border-r sm:pr-4">
					<input name="attendences[{{ $employee->id }}]" class="leading-tight" type="radio"
						   value="presence">
					<span class="text-success">Attend</span>
				</label>

				<label class="ml-4  text-gray-500 font-semibold">
					<input name="attendences[{{ $employee->id }}]" class="leading-tight" type="radio"
						   value="absent">
					<span class="text-danger">Absence</span>
				</label>

			@endif

	

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
</form>
	<br>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	
	</div>
	
	</div>

	@endsection