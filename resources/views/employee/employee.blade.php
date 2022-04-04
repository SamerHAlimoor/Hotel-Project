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
        <h4 class="card-title float-left mt-2">Employee</h4>
        <a href="{{route('form.addemployee.page')}}" class="btn btn-primary float-right veiwbutton">Add Employee</a>
        </div>
        </div>
        </div>
        </div>
        <div class="row">
        <div class="col-lg-12">
        <form>
        <div class="row formtype">
        <div class="col-md-3">
        <div class="form-group">
        <label>Employee ID</label>
        <input type="text" class="form-control" id="usr">
        </div>
        </div> <div class="col-md-3">
        <div class="form-group">
        <label>Employee Name</label>
        <input type="text" class="form-control" id="usr1">
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
        <label>Role</label>
        <select class="form-control" id="sel1" name="sellist1">
        <option>Admin</option>
        <option>Manager</option>
        <option>Staff</option>
        <option>Accountant</option>
        </select>
        </div>
        </div>
        <div class="col-md-3">
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
        <th>Name</th>
        <th>Employee ID</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Join Date</th>
        <th>role</th>
        <th class="text-right">Actions</th>
        </tr>
        </thead>
        <tbody>
            @forelse ($allEmployee as $employee)
        <tr>
            <td hidden class="id">{{ $employee->id }}</td>
        <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
        <td>{{ $employee->username }}</td>
        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="b7d6dbd5ded9d6c4dedad8d9dec4f7d2cfd6dac7dbd299d4d8da">[email&#160;protected]</a></td>
        <td>{{ $employee->ph_number }}</td> 
        <td>{{ $employee->joining_date }}</td>

        <input class="form-control fileupload" type="hidden" id="image" name="image" value="{{$employee->fileupload}}">
                <td>
        <span class="custom-badge status-green">
            @switch($employee->role)
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

        </span>
        </td>
        <td class="text-right">
        <div class="dropdown dropdown-action">
        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v ellipse_color"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="{{route('form.employee.edit',$employee->id)}}"><i class="fas fa-pencil-alt m-r-5"></i> Edit</a>
        <a class="dropdown-item employeeDelete" href="" data-toggle="modal" data-target="#delete_asset"><i class="fas fa-trash-alt m-r-5"></i> Delete</a>
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
        </div>
     
 {{-- Model delete --}}
 <div id="delete_asset" class="modal fade delete-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('form.employee.delete') }}" method="POST">
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

{{-- delete model --}}
<script>
$(document).on('click','.employeeDelete',function()
{
    var _this = $(this).parents('tr');
    $('#e_id').val(_this.find('.id').text());
  //  $('#e_fileupload').val(_this.find('.fileupload').text());
});
</script>

        @endsection