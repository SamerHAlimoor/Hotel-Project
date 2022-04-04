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
								<h3 class="page-title mt-5">Control Leaves</h3> </div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<form action="{{ route('form.leave.update') }}" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="row formtype">
									<div class="col-md-4">
										<div class="form-group">
											<label>Name Employee</label>
											<input type="hidden" class="form-control text-center font-weight-bold "  name="id" value="{{ $leave->id }}">

												<input type="text" class="form-control text-center font-weight-bold " readonly name="name" value="{{ $leave->emp->first_name }} {{ $leave->emp->last_name }}">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>From</label>
											<div class="cal-icon">
												<input type="text" class="form-control datetimepicker" name="from" readonly value="{{$leave->from}}"> </div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>To</label>
											<div class="cal-icon">
												<input type="text" class="form-control datetimepicker" name="to" readonly value="{{$leave->to}}" > </div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Numbers Of Days</label>
												<input type="text" class="form-control text-center font-weight-bold " readonly name="numberofdays" value="{{ $leave->numberofdays }}">
										</div>
									</div>
									
								
									
									<div class="col-md-4">
										<div class="form-group">
											<label>Leave Reason</label>
											<textarea class="form-control" readonly name="leave_reason" rows="2" cols="2"> {{ $leave->leave_reason}}</textarea>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Leave Status</label>
											<select class="form-control" id="sel1" name="status">
												<option value="0"> Pending </option>
												<option value="1"> Approved </option>
												<option value="2"> Rejected </option>
										
											</select>
										</div>
									</div>
									<div class="col-md-8" style="height: 200px">
										<div class="form-group">
											<label>Photo</label>
											<div class="custom-file mb-3">
												<img src="{{ URL::asset($img) }}" alt="{{ $leave->emp->first_name }} {{ $leave->emp->last_name }}" width="100%" height="200px">

											</div>
										</div>
									
									</div>
									
									
								</div>
								<button type="submit" class="btn btn-primary buttonedit ml-2  mb-4 text-center ">Update</button>

							
							</form>
						</div>
					</div>
				</div>
			</div>
	</div>
	
		
	@endsection