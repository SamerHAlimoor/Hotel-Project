@extends('layouts.master')
@section('menu')
@extends('sidebar.main-sidebar')
@endsection
@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}



	
<div class="page-wrapper">
	<div class="content mt-5">
	<div class="row mt-5">
	<div class="col-sm-12">
	<h4 class="page-title">Create Invoice</h4>
	</div>
	</div>
	<div class="row">
	<div class="col-sm-12">
		<form method="post" action="{{ route('form.Invoice.save') }}">

			@csrf
	<div class="row mt-5">
	<div class="col-md-3">
	<div class="form-group">
	<label>Room Type</label>
	<select class="form-control" id="sel1" name="type1">
	<option>Select</option>
	<option>Single</option>
	<option>Double</option>
	<option>Quad</option>
	<option>King</option>
	<option>Suite</option>
	<option>Villa</option>
	</select>
	</div>
	</div>
	<div class="col-md-3">
	<div class="form-group">
	<label>Room Type</label>
	<select class="form-control" id="sel2" name="type2">
	<option>Select</option>
	<option>Single</option>
	<option>Double</option>
	<option>Quad</option>
	<option>King</option>
	<option>Suite</option>
	<option>Villa</option>
	</select>
	</div>
	</div>
	<div class="col-md-3">
	<div class="form-group">
	<label>Email</label>
	<input class="form-control" type="email" name="email">
	</div>
	</div>
	<div class="col-md-3">
	<div class="form-group">
	<label>Room Type</label>
	<select class="form-control" id="sel3" name="type3">
	 <option>Select</option>
	<option>Single</option>
	<option>Double</option>
	<option>Quad</option>
	<option>King</option>
	<option>Suite</option>
	<option>Villa</option>
	</select>
	</div>
	</div>
	<div class="col-md-3">
	<div class="form-group">
	<label>Customer Address</label>
	<textarea class="form-control" rows="3" name="address"></textarea>
	</div>
	</div>
	<div class="col-md-3">
	<div class="form-group">
	<label>Billing Address</label>
	<textarea class="form-control" rows="3" name="bill"></textarea>
	</div>
	</div>
	<div class="col-md-3">
	<div class="form-group">
	<label>Invoice date <span class="text-danger">*</span></label>
	<div class="cal-icon">
	<input class="form-control datetimepicker" type="text" name="date">
	</div>
	</div>
	</div>
	<div class="col-md-3">
	<div class="form-group">
	<label>Due Date <span class="text-danger">*</span></label>
	<div class="cal-icon">
	<input class="form-control datetimepicker" type="text" name="date2">
	</div>
	</div>
	</div>
	</div>
	<div class="row">
	<div class="col-md-12 col-sm-12">
	<div class="table-responsive repeater">
		
	<table class="table table-hover table-white "  id="myTable">
	<thead>
	<tr>
	<th style="width: 20px">#</th>
	<th class="col-sm-2">Item</th>
	<th class="col-md-6">Description</th>
	<th style="width:100px;">Unit Cost</th>
	<th style="width:80px;">Qty</th>
	<th>Amount</th>
	<th> </th>
	</tr>
	</thead>
	<tbody data-repeater-list="List_Items">
	
		<tr >
			<td>#</td>
			<td>
			<input class="form-control" type="text" style="min-width:150px" name="item[]">
			</td>
			<td>
			<input class="form-control" type="text" style="min-width:150px" name="description[]">
			</td>
			<td>
			<input class="form-control priceCell" style="width:100px" type="text" name="unit_cost[]">
			</td>
			<td>
			<input class="form-control" style="width:80px" type="text" name="qty[]">
			</td>
			<td>
			<input class="form-control" readonly="" style="width:120px" type="text" name="amount[]">
			</td>
			<td><a onclick="toAdd()" class="text-success font-18" title="Add"><i class="fas fa-plus"></i></a></td>
			</tr>
			<tr>
	
	<td>#</td>
	<td>
	<input class="form-control" type="text" style="min-width:150px" name="item[]">
	</td>
	<td>
	<input class="form-control" type="text" style="min-width:150px" name="description[]">
	</td>
	<td>
	<input class="form-control priceCell"  style="width:100px" type="text" name="unit_cost[]">
	</td>
	<td>
	<input class="form-control" style="width:80px" type="text" name="qty[]">
	</td>
	<td>
	<input class="form-control" readonly="" style="width:120px" type="text" name="amount[]">
	</td>
	<td><a href="javascript:void(0)" class="text-danger font-18" title="Remove"><i class="fas fa-trash-alt"></i></a></td>
	</tr>
	</tbody>
	</table>
	</div>
	<div class="table-responsive">
	<table class="table table-hover table-white">
	<tbody >
	<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td class="text-right">Total</td>
	<td style="text-align: right; padding-right: 30px;width: 230px">0
	</td>
	</tr>
	<tr>
	<td colspan="5" class="text-right">Tax</td>
	<td style="text-align: right; padding-right: 30px;width: 230px">
	<input class="form-control text-right form-amt" value="0" readonly="" type="text" name="tax">
	</td>
	</tr>
	<tr>
	<td colspan="5" class="text-right">
	Discount %
	</td>
	<td style="text-align: right; padding-right: 30px;width: 230px">
	<input class="form-control text-right" type="text" name="discount">
	</td>
	</tr>
	<tr>
	<td colspan="5" style="text-align: right; font-weight: bold">
	Grand Total
	</td>
	<td style="text-align: right; padding-right: 30px; font-weight: bold; font-size: 16px;width: 230px">
	$ 0.00
	</td>
	</tr>
	</tbody>
	</table>
	</div>
	<div class="row">
	<div class="col-md-12">
	<div class="form-group">
	<label>Other Information</label>
	<textarea class="form-control" name="information"></textarea>
	</div>
	</div>
	</div>
	</div>
	</div>
	<P class="text-center mt-4 ">
		<button class="btn btn-success pl-4 pr-4 " type="submit">  Save  </button>
	</P>	</form>
	</div>
	</div>
	</div>
	</div>
	<script>
		$('.repeater').repeater({
  defaultValues: {
    'this_id': '1',
    'this_name': 'foo'
  }
});
		
		function toAdd() {
		//var i=2;
			var table = document.getElementById("myTable");
			var tbodyRowCount = table.tBodies[0].rows.length; // 3

  var row = table.insertRow(tbodyRowCount);
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  var cell4 = row.insertCell(3);
  var cell5 = row.insertCell(4);
  var cell6 = row.insertCell(5);
  var cell7 = row.insertCell(6);
  cell1.innerHTML = "<td>#</td>";
  cell2.innerHTML = '<input class="form-control" type="text" style="min-width:150px" name="item[]">';
  cell3.innerHTML = '<input class="form-control" type="text" style="min-width:150px" name="description[]">';
  cell4.innerHTML = '<input class="form-control priceCell" style="width:100px" type="text" name="unit_cost[]">';
  cell5.innerHTML = '<input class="form-control" style="width:80px" type="text" name="qty[]">';
  cell6.innerHTML = '<input class="form-control" readonly="" style="width:120px" type="text" name="amount[]">';
  cell7.innerHTML = '<a onclick="toAdd()" class="text-success font-18" title="Add"><i class="fas fa-plus"></i></a>';
  
	//console.log("Samer");
}

function calculate(){
	var records = document.getElementById('myTable').rows, i, total = 0, quantity=0, price;

for (i = 0; i < records.length; i++) {
    quantity = parseInt(records[i].cells[4].innerHTML, 10);
    price = parseFloat(records[i].cells[3].innerHTML);
    total += quantity * price;
}

total = total.toFixed(2);

console.log(price);
}
		</script>
		@endsection