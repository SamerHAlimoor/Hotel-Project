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
								<h4 class="card-title float-left mt-2">All Staff</h4> <a href="add-staff.html" class="btn btn-primary float-right veiwbutton">Add Staff</a> </div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<form>
							<div class="row formtype">
								<div class="col-md-3">
									<div class="form-group">
										<label>Staff ID</label>
										<input class="form-control" type="text" value=""> </div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Staff Name</label>
										<input class="form-control" type="text" value=""> </div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Role</label>
										<select class="form-control" id="sel1" name="rolesearch">
											<option>Select</option>
											<option>Staff</option>
											<option>Manager</option>
											<option>Receptionalist</option>
											<option>Accountant</option>
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Search</label> <a href="#" class="btn btn-success btn-block mt-0 search_button"> Search </a> </div>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="card card-table">
							<div class="card-body booking_card">
								<div class="table-responsive">
									<table class="datatable table table-stripped table table-hover table-center mb-0">
										<thead>
											<tr>
												<th>Name</th>
												<th>Staff ID</th>
												<th>Email</th>
												<th>Ph.Number</th>
												<th>Join Date</th>
												<th>Leaving Time</th>
												<th>On Duty</th>
												<th>Role</th>
												<th>Status</th>
												<th class="text-right">Actions</th>
											</tr>
										</thead>
										<tbody>
										@forelse ($allstaff as $staff)
										<tr>
											<td>
												<h2 class="table-avatar">
												<a href="#" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="{{ URL::to('/assets/upload/'.$staff->fileupload) }}" alt="{{ $staff->fileupload }}"></a>
												<a href="#">{{ $staff->first_name  }} {{$staff->last_name}}<span>{{ $staff->staff_id }}</span></a>
												</h2>
											</td>
											<td>{{ $staff->staff_id }}</td>
											<td>{{ $staff->email }}</td>
											<td>{{ $staff->ph_number }}</td>
											<td>{{ $staff->joining_date }}</td>
											<td>{{ $staff->leaving_time }}</td>
											<td>
												@switch($staff->onDuty)
													@case(0)
														Yes
														@break
													@case(1)
														No
														@break
													@default
														
												@endswitch
												
											</td>
											<td>
												<div class="actions"> <a href="#" class="btn btn-sm bg-success-light mr-2">
													@switch($staff->role)
													@case(1)
													Admin
														@break
													@case(2)
													Manager
														@break
													
													@case(3)
													Staff
														@break
													
													@case(4)
													Room Cleaners
														@break
													
													@case(5)
													Servants
														@break
													
													@case(6)
													Accountant
														@break
													
													@case(7)
													Receiptionalist
													@break

													@default
													Workers
													@break
											
												@endswitch
													
													
													
													</a> </div>
											</td>
											<td>
												<div class="actions"> <a href="#" class="btn btn-sm bg-success-light mr-2">
													@switch($staff->status)
													@case(0)
														Active
														@break
													@case(1)
														Dis Active
														@break
													@default
														
												@endswitch
													
													</a> </div>
											</td>
											
											<td class="text-right">
												<div class="dropdown dropdown-action"> <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v ellipse_color"></i></a>
													<div class="dropdown-menu dropdown-menu-right"> <a class="dropdown-item" href="edit-staff.html"><i class="fas fa-pencil-alt m-r-5"></i> Edit</a> <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_asset"><i class="fas fa-trash-alt m-r-5"></i> Delete</a> </div>
												</div>
											</td>
										</tr>
										
										@empty
											
										@endforelse
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection