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
					<th style="width:1%;">#</th>
					<th style="width:10%;" >Item</th>
					<th style="width:25%;" >Employee Name</th>
					<th style="width:10%;">Employee Department</th>
					<th style="width:25%;">Ordered By</th>
					<th style="width:10%;">Order Date</th>
					<th style="width:6%;">Order Status</th>
					<th style="width:6%;"></th>
				</thead>
				<tbody>
					@foreach($order as $data)
						<tr>
							<td> {{ $data->id }} </td>
							<td> {{ $data->category->name }} </td>
							<td> {{ $data->employee->sir_name }}, {{ $data->employee->other_name }} </td>
							<td> {{ $data->employee->department->name }} </td>
							<td> {{ $data->user->name }}, ( {{ $data->user->role->name }} ) </td>
							<td> {{ $data->created_at }} </td>
							<td>
								@if( $data->status == 0 )
									<p class="btn btn-solid btn-warning text-white">PENDING</p>
								@else
									<p class="btn btn-solid btn-success text-white">ISSUED</p>
								@endif
							</td>
							<td>
								<div class="row">
									<div class="col-5 col-sm-12 col-md-2 col-lg-2">
										<a class="btn btn-outline-info rounded-circle" href=" {{ route('order.edit',$data->id) }} ">
											<i class="fas fa-eye display-5"></i>
										</a>
									</div>
									<div class="col-5 col-sm-12 col-md-2 col-lg-2 ml-1 pl-3">
										<form action=" {{ route('order.destroy',$data->id ) }} " method="post">
											@csrf
											@method('delete')
											<button type="submit" class="btn btn-outline-danger rounded-pill ml-4"/>
												<i class="fas fa-trash-alt display-5"></i>
											</button>
										</form>
									</div>
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
