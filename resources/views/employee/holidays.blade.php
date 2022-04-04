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
<h4 class="card-title float-left mt-2" >Holidays 
    <span id="date"></span>

</h4>
<a href="{{route('form.addHoliday.page')}}" class="btn btn-primary float-right veiwbutton">Add
Holiday</a>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="card card-table">

<div class="card-body">
<div class="table-responsive">
<table class="table table-hover table-center mb-0">
<thead>
<tr>
<th>#</th>
<th>Title</th>
<th>Holiday Date</th>
<th>No Of Holidays</th>
<th>Status</th>
<th class="text-right">Actions</th>
</tr>
</thead>
<tbody>
    @forelse ($holidays as $index=>$holiday)
    <tr>
        <td hidden class="id">{{ $holiday->id }}</td>
        <td >{{ $index +1 }}</td>
    <td>{{ $holiday->title }}</td>
    <td>{{ $holiday->date }}</td>
    <td>{{ $holiday->numberofholidays }}</td>
    
   
    <td>
        @switch($holiday->status)
        @case(0)
        <span class="badge badge-warning"> Active</span>
       
            @break
            @default
        
        <span class="badge badge-info"> Dis Active</span>
        
            @break

    @endswitch

    </td>
    <td class="text-right">
    <div class="dropdown dropdown-action">
    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v ellipse_color"></i></a>
    <div class="dropdown-menu dropdown-menu-right">
    <a class="dropdown-item" href="{{route('form.Holiday.edit',$holiday->id)}}"><i class="fas fa-pencil-alt m-r-5"></i> Edit</a>

    <a class="dropdown-item holidayDelete" href="#" data-toggle="modal" data-target="#delete_asset"><i class="fas fa-trash-alt m-r-5"></i> Delete</a>
    </div>
    </div>
    </td>
    </tr>
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
            <form action="{{ route('form.Holiday.delete') }}" method="POST">
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

</div>
<script>
    var n =  new Date();
    document.getElementById("date").innerHTML =  n.getFullYear();
    </script>
     <script>
        $(document).on('click','.holidayDelete',function()
        {
            var _this = $(this).parents('tr');
            $('#e_id').val(_this.find('.id').text());
          //  $('#e_fileupload').val(_this.find('.fileupload').text());
        });
        </script>
@endsection