@extends('adminlte::page')
@section('title','Optiven Inventory')

@section('content_header')
	<h1>Department</h1>
@stop

@section('right-sidebar')
	<p>Content</p>
@stop

@section('content')
	
	<div class="row m-0 p-2 justify-content-center">
		<div class="col-md-10 col-lg-10 col-sm-10 bg-white p-3">
			<p class="text-center">ISSUE ITEM FORM</p>
			<form class="border border-2 p-3">
				<fieldset>
				 <div class="form-row">
				 		<input type="hidden" name="issue_id" id="issue_id" value=" {{ $issue->id }} ">
						<div class="form-group col-md-6">
							      <label for="category">ITEM</label>
							      <select name="category" id="inventory_category" class="form-control">
							      	<option>{{ $issue->inventory->category->name }} </option>
							      	<option>
							      		------------------------------------------------------------------------------------------------------
							      	</option>
							      	@foreach($category as $data)
							      		<option value=" {{ $data->category_id }} "> {{ $data->name }} </option>
							      	@endforeach
							      </select>
							    </div>
							    <div class="form-group col-md-6">
							      <label for="employee_dets">EMPLOYEE</label>
							      <select name="brand" id="employee_dets" class="form-control">
							      	<option value=" {{ $issue->employee_id }} "> {{ $issue->employee->sir_name }}, {{ $issue->employee->other_name }} </option>
							      	<option>
							      		------------------------------------------------------------------------------------------------------
							      	</option>
							      	@foreach($employee as $data)
							      		<option value=" {{ $data->employee_id }} "> {{ $data->sir_name }}, {{ $data->other_name }} ( {{ $data->name }} ) </option>
							      	@endforeach
							      </select>
							    </div>
							  </div>
				<div class="form-row">
					<label for="item_details">ITEM DETAILS</label>
					<select id="item_details" class="form-control">
						<option value=" {{ $issue->inventory_id }} "> {{ $issue->inventory->model_number }} {{ $issue->inventory->serial_number }} </option>
						<option>-- SELECT INVENTORY ITEM --</option>
					</select>

				</div>
				<div class="form-row mt-2">
					<label>SELECT RETURN DATE</label>
					<input type="date" value="{{ $issue->expected_return_date }}" name="date" class="form-control" id="return_date">
				</div>
				<div class="form-row text-center mt-4">
					<button class="btn btn-solid btn-success" id="submit_inventory">UPDATE RECORD</button>
				</div>
				</fieldset>
			</form>
		</div>
	</div>

@stop

@section('js')
	<script type="text/javascript">
	
		
		// $('.pending').on('click',function(e){
		// 	console.log('clicked');
		// });

		$('#inventory_category').on('change',function(e){
			var cat_value = $('#inventory_category').val();
			// console.log(cat_value);

			$.ajax({

				url:' {{ route('issue.category') }} ',
				type:'POST',
				dataType:'json',
				data:{
						"_token":" {{ csrf_token() }} ",
						category:cat_value,
				},
				success:function(response)
				{
					// console.table(response[0].Data[0]);

					console.log(response[0].Data.length);

					var select = document.getElementById("item_details");
					var length = select.options.length;
					for (i = length-1; i >= 0; i--) {
					  select.options[i] = null;
					}

					if (response[0].Data.length > 0 ) 
					{

						for (var i = 0; i < response[0].Data.length; i++) 
						{
							var option_str = "<option value="+response[0].Data[i].id+">"+
												response[0].Data[i].serial_number+" "+
												response[0].Data[i].model_number
												+" ("+response[0].Data[i].description+") "+
										 "</option>";

						$("#item_details").append(option_str);
					
						}
					}
					else
					{
						var option_str = "<option>"+
											"THE ITEM IS NOT AVAILABLE AT THE MOMENT"+
										 "</option>";
						$('#item_details').append(option_str);
					}


				},
				error:function(response)
				{
					console.log(response);
				}
			
			});

		});

		$('#submit_inventory').on('click',function(e){
			
			e.preventDefault();
			// console.log('prevented');

			var employee_id = $('#employee_dets').val();
			// var category_id = $('#inventory_category').val();
			var inventory_id = $('#item_details').val();
			var return_date = $('#return_date').val();
			var id = $('#issue_id').val();

			console.log(employee_id);

			$.ajax({

				url:' {{ route('issue.update','id') }} ',
				type:'PUT',
				dataType:'json',
				data:{
					"_token":" {{ csrf_token() }} ",
					employee_id:employee_id,
					inventory_id:inventory_id,
					return_date:return_date,
					id:id,
				},
				success:function(response){
					console.log(response);
					if (response[0].response_code === 200) 
			   			{
							swal.fire("Done!", "Record Updated Successfully" , "success");
						} 
				},
				error:function(response){
					console.log(response);
				}

			});

		});


		 // $('#itemDisplay').DataTable();
		  // $('#employeeDisplay').DataTable();

		// $('#create').on('click', function(e) 
		// {
		// 	    e.preventDefault();
		// 	    e.stopPropagation(); // only neccessary if something above is listening to the (default-)event too
		// 	    var department = $('#department').val();
		// 	   // console.log('Prevented');

		// 	   $.ajax({

		// 	   		url:' {{ route("department.store") }} ',
		// 	   		type:'POST',
		// 	   		data:{

		// 	   				"_token":" {{ csrf_token() }} ",
		// 	   				department:department,
		// 	   		},
		// 	   		dataType:'json',
		// 	   		success:function(response)
		// 	   		{
		// 	   			console.log(response);
		// 	   			if (response[0].response_code === 201) 
		// 	   			{
		// 					swal.fire("Done!", response[0].message, "success");
		// 				} 
		// 	   		}
		// 	   });

		// 	});
	</script>
@stop
