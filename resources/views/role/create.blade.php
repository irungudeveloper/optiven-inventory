@extends('adminlte::page')
@section('title','Optiven Inventory')

@section('content_header')
	<h1>Roles</h1>
@stop

@section('content')
	<div class="row m-2 justify-content-center">
		<div class="col-md-10 col-lg-10 col-sm-12">
			<div class="card">
				<div class="card-header">
					<p class="text-center">ROLES FORM</p>
				</div>
				<div class="card-body">
					<form method="post">
						@csrf
						<div class="form-group row">
						    <label for="role" class="col-sm-2 col-form-label">Role Name</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" id="role" placeholder="Name" name="role">
						   </div>
						  </div>
						<div class="form-group text-center">
							<button class="btn btn-success pl-4 pr-4" id="submit">INSERT ROLE</button>
							<!-- <input type="submit" name="submit" class="btn btn-success pl-4 pr-4" value="INSERT ROLE"> -->
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@stop

@section('js')
	<script type="text/javascript">
		$('#submit').on('click',function(e) 
		{
			e.preventDefault();
			// console.log('stopped');
			// var role =document.getElementById('role');
			var role = $('#role').val();
			console.log(role);

			$.ajax({

				url:" {{ route('role.store') }} ",
				type:'POST',
				data:{
						"_token": '{{ csrf_token() }}',
						role:role,
				},
				dataType:"json",
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
