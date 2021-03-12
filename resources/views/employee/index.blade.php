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
			<table id="myTable" class="table table-striped table-bordered" style="width: 100%">
				<thead class="bg-white">
					<th>#</th>
					<th>Sir Name</th>
					<th>Other Name(s)</th>
					<th>Phone Number</th>
					<th>Email</th>
					<th>Department</th>
					<th></th>
				</thead>
				<tbody>
					@foreach($employee as $data)
						<tr>
							<td> {{ $data->id }} </td>
							<td> {{ $data->sir_name }} </td>
							<td> {{ $data->other_name }} </td>
							<td> {{ $data->phone_number }} </td>
							<td> {{ $data->email }} </td>
							<td> {{ $data->department->name }} </td>
							<td></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@stop

@section('js')
    <script>
    	 $('#myTable').DataTable();
     </script>
@stop
