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
			<table id="myTable" class="table table-striped table-bordered table-responsive" style="width: 100%">
				<thead class="bg-white">
					<th >#</th>
					<th >Serial Number</th>
					<th >Model Number</th>
					<th >Category</th>
					<th >Brand</th>
					<th >Description</th>
					<th >Status</th>
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
							<td>
								<div class="row">
									<div class="col-5 col-sm-12 col-md-2 col-lg-2">
										<a class="btn btn-outline-info rounded-circle" href=" {{ route('inventory.edit',$data->id) }} ">
											<i class="fas fa-eye"></i>
										</a>
									</div>
									@can('super_admin')
									<div class="col-5 col-sm-12 col-md-2 col-lg-2">
										<form action=" {{ route('inventory.destroy',$data->id ) }} " method="post">
											@csrf
											@method('delete')
											<button type="submit" class="btn btn-outline-danger rounded-pill ml-5"/>
												<i class="fas fa-trash-alt"></i>
											</button>
										</form>
									</div>
									@endcan
								</div>			
							</td>
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
