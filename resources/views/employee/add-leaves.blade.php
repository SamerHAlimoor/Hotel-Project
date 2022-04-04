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
								<h3 class="page-title mt-5">Add Leave</h3> </div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<form action="{{ route('form.leave.save') }}" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="row formtype">
									<div class="col-md-4">
										<div class="form-group">
											<label>Leave Type</label>
											<select class="form-control" id="sel1" name="leave_type">
												<option value=""> Select </option>
												<option value="0"> Casual Leave </option>
												<option value="1"> Medical Leave </option>
												<option value="2"> Loss of Pay </option>
												<option value="3"> Others </option>
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>From</label>
											<div class="cal-icon">
												<input type="text" class="form-control datetimepicker" name="from" > </div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>To</label>
											<div class="cal-icon">
												<input type="text" class="form-control datetimepicker" name="to" > </div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="form-group">
											<label>Prove File</label>
											<div class="custom-file mb-3">
												
												<input type="file" class="custom-file-input @error('fileupload') is-invalid @enderror" id="fileupload" name="fileupload">
												<label class="custom-file-label" for="customFile">Choose file</label>
											</div>
										</div>
									
									</div>
								</div>
									<div class="col-md-12">
										<div class="form-group">
											<label>Leave Reason</label>
											<textarea class="form-control" rows="5" id="comment" name="leave_reason"></textarea>
										</div>
									</div>
								</div>
								<div class="col-md-12 text-center">
									<div class="form-group text-center">
										<button type="submit" class="btn btn-primary buttonedit ml-2 ">Send Leave Request</button>
							</div>
						
						
						</div>
							</form>
						</div>
					</div>
				</div>
			</div>
	</div>
	
		
	@endsection