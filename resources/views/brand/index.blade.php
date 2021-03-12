@extends('adminlte::page')
@section('title','Optiven Inventory')

@section('content_header')
@stop

@section('right-sidebar')
	<p>Content</p>
@stop

@section('content')
	<div class="row m-2 justify-content-center">
		<div class="col-md-10 col-lg-10 col-sm-12">
			<table id="myTable" class="table table-striped table-bordered" style="width: 100%">
				<thead>
					<th>#</th>
					<th>Name</th>
					<th></th>
				</thead>
				<tbody>
					@foreach($brand as $data)
						<tr>
							<td> {{ $data->id }} </td>
							<td> {{ $data->name }} </td>
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
