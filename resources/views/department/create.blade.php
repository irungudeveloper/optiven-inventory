@extends('adminlte::page')
@section('title','Optiven Inventory')

@section('content_header')
	<h1>Department</h1>
@stop

@section('right-sidebar')
	<p>Content</p>
@stop

@section('content')
	<div class="row m-2 justify-content-center">
		<div class="col-md-10 col-lg-10 col-sm-12">
			<div class="card">
				<div class="card-header">
					<p class="text-center">DEPARTMENT FORM</p>
				</div>
				<div class="card-body">
					<form method="post">
						@csrf
						<div class="form-group row">
						    <label for="department" class="col-sm-2 col-form-label">Department Name</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" id="department" placeholder="Name" name="department">
						   </div>
						  </div>
						<div class="form-group text-center">
							<input type="button" name="submit" class="btn btn-success pl-4 pr-4" value="INSERT DEPARTMENT" id="create">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@stop

@section('js')
	<script type="text/javascript">
		$('#create').on('click', function(e) 
		{
			    e.preventDefault();
			    e.stopPropagation(); // only neccessary if something above is listening to the (default-)event too
			    var department = $('#department').val();
			   // console.log('Prevented');

			   $.ajax({

			   		url:' {{ route("department.store") }} ',
			   		type:'POST',
			   		data:{

			   				"_token":" {{ csrf_token() }} ",
			   				department:department,
			   		},
			   		dataType:'json',
			   		success:function(response)
			   		{
			   			console.log(response);
			   			if (response[0].response_code === 201) 
			   			{
							swal.fire("Done!", response[0].message, "success");
						} 
			   		}
			   });

			});
	</script>
@stop
