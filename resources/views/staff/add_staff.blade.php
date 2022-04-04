@extends('layouts.master')
@section('menu')
@extends('sidebar.main-sidebar')
@endsection
@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}



	<div class="page-wrapper">
		<div class="content container-fluid">
			<div class="card-body booking_card">
			<div class="page-header">
				<div class="row align-items-center">
					<div class="col">
						<h3 class="page-title mt-5">Add Staff</h3> </div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<form action="{{ route('form.staff.save') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="row formtype">
							<div class="col-md-4">
								<div class="form-group">
									<label>First Name</label>
									<input class="form-control" name="first_name" type="text" value="{{ old('first_name') }}"> </div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Last Name</label>
									<input class="form-control"  name="last_name" type="text" value="{{ old('last_name') }}"> </div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>User Name</label>
									<input class="form-control"  name="username" type="text" value="{{ old('username') }}"> </div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Email ID</label>
									<input class="form-control"  name="email" type="email" value="{{ old('email') }}"> </div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Password</label>
									<input class="form-control"  name="password" type="password" value="{{ old('password') }}"> </div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Confirm Password</label>
									<input class="form-control"  name="password" type="password" value="{{ old('password') }}"> </div>
							</div>
						
							<div class="col-md-4">
								<div class="form-group">
									<label>Joining Date</label>
									<div class="cal-icon">
										<input type="text" name="joining_date" class="form-control datetimepicker" value="{{ old('joining_date') }}"> </div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Leaving Time</label>
									<div class="cal-icon">
										<input type="time" name="leaving_time" class="form-control " value="{{ old('leaving_time') }}"> </div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Phone Number</label>
									<input class="form-control" name="ph_number" type="text" value="{{ old('ph_number') }}"> </div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label>On Duty</label>
									<select class="form-control" id="sel1" name="onDuty" >
										<option value="0">Yes</option>
										<option value="1">No</option>
										
									</select>
								</div>
							</div>
						
							<div class="col-md-4">
								<div class="form-group">
									<label>Role</label>
									<select class="form-control" id="sel1" name="role" >
										<option value="0">Select The Role</option>
										<option value="1">Admin</option>
										<option value="2">Manager</option>
										<option value="3" >Staff</option>
										<option value="4">Room Cleaners</option>
										<option value="5">Servants</option>
										<option value="6">Accountant</option>
										<option value="7">Receiptionalist</option>
									</select>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label>Status</label>
									<select class="form-control" id="status" name="status" >
										<option value="0">Active</option>
										<option value="1">Diss  Active</option>
										
									</select>
								</div>
							
							</div>
							<div class="col-md-12">
								<div class="form-group">
                                    <label>File Upload</label>
                                    <div class="custom-file mb-3">
                                        <input type="file" class="custom-file-input @error('fileupload') is-invalid @enderror" id="fileupload" name="fileupload">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
							
							</div>
						</div>
						<div class="col-md-12 text-center">
							<div class="form-group text-center">
						<button type="submit" class="btn btn-primary buttonedit ml-2 ">Add Staff</button>
					</div>	</div>
					</form>
				</div>
			</div>
		</div>
			
		</div>
	</div>

	@endsection