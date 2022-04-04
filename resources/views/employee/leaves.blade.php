﻿        @extends('layouts.master')
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
    <h4 class="card-title float-left mt-2">Leave Request</h4>
    <a href="{{route('form.addleave.page')}}" class="btn btn-primary float-right veiwbutton">Add Leave</a>
    </div>
    </div>
    </div>
    </div>
    <div class="row">
    <div class="col-lg-12">
    <form>
    <div class="row formtype">
    <div class="col-md-4">
    <div class="form-group">
    <label>Empployee Name</label>
    <input class="form-control" type="text" value="">
    </div>
    </div>
    <div class="col-md-4">
    <div class="form-group">
    <label>Leave Type</label>
    <select class="form-control" id="sel1" name="sellist1">
    <option>Select</option>
    <option>Casual Leave</option>
    <option>Medical Leave</option>
    <option>Loss Of Pay</option>
    </select>
    </div>
    </div>
    <div class="col-md-4">
    <div class="form-group">
    <label>Leave Status</label>
    <select class="form-control" id="sel2" name="sellist1">
    <option>Select</option>
    <option>Pending</option>
    <option>Approved</option>
    <option>Rejected</option>
    </select>
    </div>
    </div>
    <div class="col-md-4">
    <div class="form-group">
    <label>From</label>
    <div class="cal-icon">
    <input type="text" class="form-control datetimepicker">
    </div>
    </div>
    </div>
    <div class="col-md-4">
    <div class="form-group">
    <label>To</label>
    <div class="cal-icon">
    <input type="text" class="form-control datetimepicker">
    </div>
    </div>
    </div>
    <div class="col-md-4">
    <div class="form-group">
    <label>Search</label>
    <a href="#" class="btn btn-success btn-block mt-0 search_button"> Search </a>
    
    </div>
    </div>
    </div>
    </form>
    </div>
    </div>
    <div class="row">
    <div class="col-sm-12">
    <div class="card">
    <div class="card-body">
    <div class="table-responsive">
    <table class="datatable table table-stripped">
    <thead>
    <tr>
    <th>Employee</th>
    <th>Leave Type</th>
    <th>From</th>
    <th>To</th>
    <th>No Of Days</th>
    <th>Reason</th>
    <th>Status</th>
    <th class="text-right">Actions</th>
    </tr>
    </thead>
    <tbody>
        @forelse ($leaves as $leave)
    <tr>
        <td hidden class="id">{{ $leave->id }}</td>
    <td>{{ $leave->emp->first_name }} {{ $leave->emp->last_name }}</td>
    <td>
        @switch($leave->leave_type)
        @case(0)
        Casual Leave
            @break
        @case(1)
        Medical Leave
            @break
        
        @case(2)
        Loss of Pay 
            @break
        @default
        Others
        @break

    @endswitch

    </td>
    <td>{{ $leave->from }}</td>
    <td>{{ $leave->to }}</td>
    <td>{{ $leave->numberofdays }}</td>
    <td>{{ $leave->leave_reason }}</td>
    <td>
        @switch($leave->status)
        @case(0)
        <span class="badge badge-warning"> Pending</span>
       
            @break
        @case(1)
        
        <span class="badge badge-info"> Approved</span>
        
            @break
        @default
        <span class="badge badge-danger"> Rejected</span>

        
        @break

    @endswitch

    </td>
    <td class="text-right">
    <div class="dropdown dropdown-action">
    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v ellipse_color"></i></a>
    <div class="dropdown-menu dropdown-menu-right">
    <a class="dropdown-item" href="{{route('form.leave.edit',$leave->id)}}"><i class="fas fa-pencil-alt m-r-5"></i> Edit</a>

    <a class="dropdown-item leaveDelete" href="#" data-toggle="modal" data-target="#delete_asset"><i class="fas fa-trash-alt m-r-5"></i> Delete</a>
    </div>
    </div>
    </td>
    </tr>
    @empty
    <tr colspan="7" rowspan="2" class="text-center">
    <td class="text-center" colspan="7" rowspan="2" class="text-center" >
        <div class="dropdown dropdown-action">	
            No Data Here 
        </div>
        </td>
    </tr>				
    @endforelse
    </tbody>
    </table>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    {{-- Model delete --}}
 <div id="delete_asset" class="modal fade delete-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('form.leave.delete') }}" method="POST">
                @csrf
                <div class="modal-body text-center"> <img src="{{ URL::to('assets/img/sent.png') }}" alt="" width="50" height="46">
                    <h3 class="delete_class">Are you sure want to delete this Asset?</h3>
                    <div class="m-t-20">
                        <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        <input class="form-control" type="hidden" id="e_id" name="id" value="">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Model delete --}}
    </div>
    <script>
        $(document).on('click','.leaveDelete',function()
        {
            var _this = $(this).parents('tr');
            $('#e_id').val(_this.find('.id').text());
          //  $('#e_fileupload').val(_this.find('.fileupload').text());
        });
        </script>
        @endsection