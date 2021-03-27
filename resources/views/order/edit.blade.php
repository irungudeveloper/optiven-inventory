@extends('adminlte::page')
@section('title','Optiven Inventory')

@section('content_header')
	<h1>EMPLOYEE</h1>
@stop

@section('right-sidebar')
	<p>Content</p>
@stop

@section('content')
	<div class="row m-2 justify-content-center">
		<div class="col-md-10 col-lg-10 col-sm-12">
			<div class="card">
				<div class="card-header">
					<p class="text-center">ORDER FORM</p>
				</div>
				<div class="card-body">
					<form method="put">
						@csrf

						<input type="hidden" name="order_id" id="order_id" value=" {{ $order->id }} ">

						<input id="user_id" type="hidden" name="user_id" value=" {{ Auth::user()->id }} ">

						 <div class="form-row mb-3">
						  	<label for="employee">Employee Name</label>
						  	<select id="employee" class="form-control">
						  		<option value=" {{ $order->employee_id }} " > {{ $order->employee->sir_name }} {{ $order->employee->other_name }} </option>
						  		<option>
						  			------------------------------------------------------------------------------------------------------------------------
						  		</option>
						  		@foreach($employee as $data)
						  			<option value=" {{ $data->id }} "> {{ $data->sir_name }}, {{ $data->other_name }} </option>
						  		@endforeach
						  	</select>
						  </div>
						  <div class="form-row mb-3">
						  	<label for="category">Order Item</label>
						  	<select id="category" class="form-control">
						  		<option value=" {{ $order->category_id }} "> {{ $order->category->name }} </option>
						  		<option>
						  		--------------------------------------------------------------------------------------------------------------------------------
						  		</option>
						  		@foreach($category as $data)
						  			<option value=" {{ $data->id }} "> {{ $data->name }} </option>
						  		@endforeach
						  	</select>
						  </div>
						   
						<div class="form-group text-center">
							<input type="button" name="submit" class="btn btn-success pl-4 pr-4" value="UPDATE DETAILS" id="create">
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
			    // var sir_name = $('#sir_name').val();
			    // var other_name = $('#other_name').val();
			  
			   // console.log('Prevented');

			   var user_id = $('#user_id').val();
			   var employee_id = $('#employee').val();
			   var category_id = $('#category').val();
			   var id = $('#order_id').val();

			   console.log(user_id);

			   $.ajax({

			   		url:' {{ route("order.update",'id') }} ',
			   		type:'PUT',
			   		dataType:'json',
			   		data:{
			   				"_token":" {{ csrf_token() }} ",
			   				user_id:user_id,
			   				employee_id:employee_id,
			   				category_id:category_id,
			   				id:id,
			   		},
			   		success:function(response)
			   		{
			   			console.log(response);
			   			if (response[0].response_code === 200) 
			   			{
							swal.fire("Done!", "Record Updated Successfully" , "success");
						} 
			   		},
			   		error:function(response)
			   		{
			   			console.log(response);
			   		}
			   });

			 

			});
	</script>
@stop
