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
					<th>Name</th>
					<th></th>
				</thead>
				<tbody>
					@foreach($categories as $data)
						<tr>
							<td> {{ $data->id }} </td>
							<td> {{ $data->name }} </td>
							<td>
								<div class="row">
									<div class="col-5 col-sm-12 col-md-2 col-lg-2">
										<a class="btn btn-outline-info rounded-circle" href=" {{ route('category.edit',$data->id) }} ">
											<i class="fas fa-eye"></i>
										</a>
									</div>
									<div class="col-5 col-sm-12 col-md-2 col-lg-2">
										<form action=" {{ route('category.destroy',$data->id ) }} " method="post">
											@csrf
											@method('delete')
											<button type="submit" class="btn btn-outline-danger rounded-pill ml-3"/>
												<i class="fas fa-trash-alt"></i>
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
