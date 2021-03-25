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
							<td>
								<div class="row">
									<div class="col-5 col-sm-12 col-md-2 col-lg-2">
										<a class="btn btn-outline-info rounded-circle" href=" {{ route('role.edit',$role->id) }} ">
											<i class="fas fa-eye display-5"></i>
										</a>
									</div>
									<div class="col-5 col-sm-12 col-md-2 col-lg-2">
										<form action=" {{ route('role.destroy',$role->id ) }} " method="post">
											@csrf
											@method('delete')
											<button type="submit" class="btn btn-outline-danger rounded-pill ml-2"/>
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
