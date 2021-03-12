@extends('adminlte::page')
@section('title','Optiven Inventory')

@section('content_header')
@stop

@section('right-sidebar')
	<p>Content</p>
@stop

@section('content')
	<div class="row m-2 justify-content-center">
		<div class="col-md-12 col-lg-12 col-sm-12 bg-white p-2">
			<table id="myTable" class="table table-striped table-bordered" style="width: 100%">
				<thead class="bg-white">
					<th width="2%">#</th>
					<th width="20%">Serial Number</th>
					<th width="20%">Model Number</th>
					<th width="5%">Category</th>
					<th width="5%">Brand</th>
					<th width="25%">Description</th>
					<th width="5%">Status</th>
					<th></th>
				</thead>
				<tbody>
					@foreach($inventory as $data)
						<tr>
							<td> {{ $data->id }} </td>
							<td> {{ $data->serial_number }} </td>
							<td> {{ $data->model_number }} </td>
							<td> {{ $data->category->name }} </td>
							<td> {{ $data->brand->name }} </td>
							<td> {{ $data->description }} </td>
							<td>
								@if($data->availability == 1)
									<p class="btn btn-solid btn-success">AVAILABLE</p>
								@else
									<p class="btn btn-solid btn-danger">NOT AVAILABLE</p>
								@endif
							</td>
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
