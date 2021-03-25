@extends('adminlte::page')
@section('title','Optiven Inventory')

@section('content_header')
@stop

@section('right-sidebar')
	<p>Content</p>
@stop

@section('content')
	<div class="row m-2 justify-content-center">
		<div class="col-md-10 col-lg-10 col-sm-12 bg-white p-2">
			<table id="myTable" class="table table-striped table-bordered table-responsive" style="width: 100%">
				<thead class="bg-white">
					<th>#</th>
					<th>Serial Number</th>
					<th>Model Number</th>
					<th>Brand</th>
					<th>Item Type</th>
					<th>Employee Name</th>
					<th>Department</th>
					<th>Return Date</th>
					<th>Return Status</th>
					<th></th>
				</thead>
				<tbody>
					@foreach($issue as $data)
						<tr>
							<td> {{ $data->id }} </td>
							<td> {{ $data->inventory->serial_number }} </td>
							<td> {{ $data->inventory->model_number }} </td>
							<td> {{ $data->inventory->brand->name }} </td>
							<td> {{ $data->inventory->category->name }} </td>
					<td> {{ $data->employee->sir_name }}, {{ $data->employee->other_name }} </td>
							<td> {{ $data->employee->department->name }} </td>
							<td> {{ $data->expected_return_date }} </td>
							<td> 

								@if( $data->status == 0 )

								<button class="btn btn-solid btn-danger unreturned" id=" {{ $data->id }} " value="{{ $data->inventory_id }}" onclick="returnFunction(this.id,this.value)">NOT RETURNED</button> 
								@else
								<button class="btn btn-solid btn-success">RETURNED</button>
								@endif
							</td>
							<td></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

	<div class="row m-2 bg-white">
		<div class="col-12 col-md-12 col-sm-12">
			
		</div>
	</div>

@stop

@section('js')
    <script>
    	 $('#myTable').DataTable();

    	 function returnFunction(id,value) 
    	 {
    	 	var inventory_id = value;
    	 	var issue_id = id;
    	 	
    	 	$.ajax({

    	 		url: ' {{ route('issue.returned') }} ',
    	 		type: 'POST',
    	 		dataType:'json',
    	 		data:{
    	 			"_token":" {{ csrf_token() }} ",
    	 			issue_id:issue_id,
    	 			inventory_id:inventory_id,
    	 		},
    	 		success:function(response)
    	 		{
    	 			console.log(response);
    	 		},
    	 		error:function(msg)
    	 		{
    	 			console.log(msg);
    	 		}

    	 	});	

    	 }

     </script>
@stop
