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
				<thead class="bg-light">
					<th>#</th>
					<th>Name</th>
					<th></th>
				</thead>
				<tbody>
					@foreach($roles as $role)
						<tr>
							<td> {{ $role->id }} </td>
							<td> {{ $role->name }} </td>
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
