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
					<p class="text-center">EMPLOYEE FORM</p>
				</div>
				<div class="card-body">
					<form method="post">
						@csrf
						 <div class="form-row">
						    <div class="form-group col-md-6">
						      <label for="sir_name">Sir_Name</label>
						      <input type="hidden" name="employee_id" id="employee_id" value=" {{ $employee->id }} ">
						      <input type="text" class="form-control" id="sir_name" placeholder="Sir Name" value=" {{ $employee->sir_name }} ">
						    </div>
						    <div class="form-group col-md-6">
						      <label for="other_name">Other Name(s)</label>
						      <input type="text" class="form-control" id="other_name" placeholder="Other Name(s)" value=" {{ $employee->other_name }} ">
						    </div>
						  </div>
						  <div class="form-row mb-3">
						  	<label for="department">Department</label>
						  	<select id="department" class="form-control">
						  		<option value=" {{ $employee->department_id }} "> {{ $employee->department->name }} </option>
						  		<option>
						  		-----------------------------------------------------------------------------------------------------------------------
						  		</option>
						  		@foreach($department as $data)
						  			<option value=" {{ $data->id }} "> {{ $data->name }} </option>
						  		@endforeach
						  	</select>
						  </div>
						   <div class="form-row">
						    <div class="form-group col-md-6">
						      <label for="phone_number">Phone Number</label>
						      <input type="text" class="form-control" id="phone_number" placeholder="Phone Number" value=" {{ $employee->phone_number }} ">
						    </div>
						    <div class="form-group col-md-6">
						      <label for="email">Work Email</label>
						      <input type="text" class="form-control" id="email" placeholder="Work Email" value=" {{ $employee->email }} ">
						    </div>
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
			    var sir_name = $('#sir_name').val();
			    var other_name = $('#other_name').val();
			    var department_id = $('#department').val();
			    var phone_number = $('#phone_number').val();
			    var email = $('#email').val();
			    var id = $('#employee_id').val();
			   // console.log('Prevented');

			   $.ajax({

			   		url:' {{ route("employee.update",'id') }} ',
			   		type:'PUT',
			   		data:{

			   				"_token":" {{ csrf_token() }} ",
			   				sir_name:sir_name,
			   				other_name:other_name,
			   				department_id:department_id,
			   				phone_number:phone_number,
			   				email:email,
			   				id:id,
			   		},
			   		dataType:'json',
			   		success:function(response)
			   		{
			   			console.log(response);
			   			if (response[0].response_code === 200) 
			   			{
							swal.fire("Done!", "Record Updated Successfully" , "success");
						} 
			   		}
			   });

			});
	</script>
@stop
