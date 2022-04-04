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
								<h3 class="page-title mt-5">Add Holiday</h3> </div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<form action="{{ route('form.Holiday.update') }}" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="row formtype">
									<div class="col-md-6">
										<div class="form-group">
											<label>Holiday Name</label>
											<input type="hidden" class="form-control text-center font-weight-bold "  name="id" value="{{ $holiday->id }}">

											<input class="form-control" type="text"  @error('title') is-invalid @enderror name="title" value="{{$holiday->title}}"> </div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Holiday Date</label>
											<div class="cal-icon">
												<input type="text" class="form-control datetimepicker" value="{{$holiday->date}}" @error('date') is-invalid @enderror name="date"> </div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>No Of Holidays</label>
											<input class="form-control" type="text" value="{{$holiday->numberofholidays}}" @error('numberofholidays') is-invalid @enderror name="numberofholidays"> </div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Holiday Status</label>
											<select class="form-control" id="sel1" name="status">
												<option value="0"> Active </option>
												<option value="1"> Dis Active </option>
												
										
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-12 text-center">
									<div class="form-group text-center">
										<button type="submit" class="btn btn-primary buttonedit ml-2 ">Update Holiday</button>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
	</div>
	@endsection