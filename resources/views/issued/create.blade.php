@extends('adminlte::page')
@section('title','Optiven Inventory')

@section('content_header')
	<h1>Department</h1>
@stop

@section('right-sidebar')
	<p>Content</p>
@stop

@section('content')
	<div class="row m-0 bg-white p-2">
		<div class="col-md-6 col-lg-4 col-sm-12">
			<p class="text-center pt-3">ISSUE BY:</p>
			<div class="row mb-2">
				<div class="col-sm-12 col-md-6 col-lg-6 text-center">
					<button class="btn btn-solid btn-info" id="category">CATEGORY</button>
				</div>
				<div class="col-sm-12 col-md-6 col-lg-6 text-center">
					<button class="btn btn-solid btn-info" id="employee">EMPLOYEE</button>
				</div>
			</div>

				<div id="category-select" class="form-row mb-3 p-2" style="display: none">
					<label for="item">Item</label>
					<select id="item" class="form-control">
						<option> -- SELECT ITEM -- </option>
						@foreach($category as $data)
							<option value="{{ $data->category_id }}"> {{ $data->name }} </option>
						@endforeach
					</select>
				</div>

				<div id="employee-select" class="form-row mb-3 p-2" style="display: none">
					<label for="employee_detail">Employee Name</label>
					<select id="employee_detail" class="form-control">
						<option> -- SELECT EMPLOYEE -- </option>
						@foreach($employee as $data)
							<option value="{{ $data->employee_id }}"> {{ $data->sir_name }}, {{ $data->other_name }} ( {{ $data->name }} ) </option>
						@endforeach
					</select>
				</div>

			
		</div>
		<div class="col-md-6 col-lg-8 col-sm-12 jumbotron  p-3">
			<p class="text-center">SELECT ITEM FIRST</p>
			<table id="itemDisplay" class="table table-hover table-responsive-md table-responsive-sm" style="display: none;">
				<thead>
					<th>#</th>
					<th>Item</th>
					<th>Employee Name</th>
					<th>Department</th>
					<th>Status</th>
				</thead>
				<tbody>
					
				</tbody>
			</table>

			<table id="employeeDisplay" class="table table-hover table-responsive"  style="display: none;">
				<thead>
					<th>#</th>
					<th>Employee Name</th>
					<th>Department</th>
					<th>Item</th>
					<th>Status</th>
				</thead>
				<tbody>
					
				</tbody>
			</table>

		</div>
	</div>

	<div class="row m-0 p-2 justify-content-center">
		<div class="col-md-10 col-lg-10 col-sm-10 bg-white p-3">
			<p class="text-center">ISSUE ITEM FORM</p>
			<form class="border border-2 p-3">
				<fieldset>
				 <div class="form-row">
						<div class="form-group col-md-6">
							      <label for="category">ITEM</label>
							      <select name="category" id="inventory_category" class="form-control">
							      	<option>--SELECT ITEM--</option>
							      	@foreach($category as $data)
							      		<option value=" {{ $data->category_id }} "> {{ $data->name }} </option>
							      	@endforeach
							      </select>
							    </div>
							    <div class="form-group col-md-6">
							      <label for="employee_dets">EMPLOYEE</label>
							      <select name="brand" id="employee_dets" class="form-control">
							      	<option>--SELECT EMPLOYEE--</option>
							      	@foreach($employee as $data)
							      		<option value=" {{ $data->employee_id }} "> {{ $data->sir_name }}, {{ $data->other_name }} ( {{ $data->name }} ) </option>
							      	@endforeach
							      </select>
							    </div>
							  </div>
				<div class="form-row">
					<label for="item_details">ITEM DETAILS</label>
					<select id="item_details" class="form-control">
						<option>-- SELECT INVENTORY ITEM --</option>
					</select>

				</div>
				<div class="form-row mt-2">
					<label>SELECT RETURN DATE</label>
					<input type="date" name="date" class="form-control" id="return_date">
				</div>
				<div class="form-row text-center mt-4">
					<button class="btn btn-solid btn-success" id="submit_inventory">ISSUE ITEM</button>
				</div>
				</fieldset>
			</form>
		</div>
	</div>

@stop

@section('js')
	<script type="text/javascript">
	
		$('#category').on('click',function(e){
			// console.log('clicked');
			$('#employee-select').hide();
			$('#category-select').show();
		});

		$('#employee').on('click',function(e){
			console.log('clicked');
			$('#employee-select').show();
			$('#category-select').hide();
		});


		$('#item').on('change',function(e){
				e.preventDefault();
				var category_id = $('#item').val(); 
				// console.log(category_id);
				// $('#itemDisplay').DataTable();
				$.ajax({
					url: '{{ route('issue.item') }}',
					type: 'POST',
					dataType:'json',
					data:{
							"_token":' {{ csrf_token() }} ',
							category_id:category_id,
						},
					success:function(response)
					{
						//clear the previous table data rows
						tblCustomers = document.getElementById('itemDisplay');

						var rowCount = tblCustomers.rows.length;
       					 for (var i = rowCount - 1; i > 0; i--)
       					  {
          					  tblCustomers.deleteRow(i);
       					  }

						var counter = response[0].Data.length;
						var id = 1;
						for (var i = 0; i < counter; i++) 
						{
							
						var status_str="<button class='btn btn-warning text-white pending' id="+response[0].Data[i].id+" onclick='pendingFunction(this.id)'>"+ "PENDING" +"</button>";

							var tr_str = "<tr>"+
									 "<td>"+ id++ +"</td>"+
									 "<td>"+ response[0].Data[i].category_name +"</td>"+
							"<td>"+ response[0].Data[i].sir_name+", "+ response[0].Data[i].other_name +"</td>"+
									 "<td>"+ response[0].Data[i].department_name +"</td>"+
									 "<td>"+ status_str +"</td>"+
									 "<tr>";

							 $("#itemDisplay tbody").append(tr_str);
							 
						}

						$("#itemDisplay").show();
						$("#employeeDisplay").hide();
						 // $("table#itemDisplay").Datatable({});

					},
					complete:function(response)
					{
						// alert('COMPLETED');
						// $('#itemDisplay').DataTable();
					}
					// error:function(response)
					// {
					// 	console.table('error');
					 // }
				});

				// $('#itemDisplay').DataTable();
		});

		$('#employee_detail').on('change',function(e){
				e.preventDefault();
				var employee_id = $('#employee_detail').val(); 
				console.log(employee_id);

				$.ajax({

					url:' {{ route('issue.employee') }} ',
					type:'POST',
					dataType:'json',
					data:{
						"_token":' {{ csrf_token() }} ',
						employee_id:employee_id,
					},
					success:function(response)
					{
						// console.table(response);

						tblCustomers = document.getElementById('employeeDisplay');

						var rowCount = tblCustomers.rows.length;
       					 for (var i = rowCount - 1; i > 0; i--)
       					  {
          					  tblCustomers.deleteRow(i);
       					  }

						var counter = response[0].Data.length;
						var id = 1;
						for (var i = 0; i < counter; i++) 
						{
							
						var status_str="<button class='btn btn-warning text-white pending' id="+response[0].Data[i].id+" onclick='pendingFunction(this.id)' >"+ "PENDING" +"</button>";

							var tr_str = "<tr>"+
									 "<td>"+ id++ +"</td>"+
							"<td>"+ response[0].Data[i].sir_name+", "+ response[0].Data[i].other_name +"</td>"+
									 "<td>"+ response[0].Data[i].department_name +"</td>"+
									  "<td>"+ response[0].Data[i].category_name +"</td>"+
									 "<td>"+ status_str +"</td>"+
									 "<tr>";

							 $("#employeeDisplay tbody").append(tr_str);
					}
					$('#itemDisplay').hide();
					$("#employeeDisplay").show();

					}

				});
		});

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

			console.log(employee_id);

			$.ajax({

				url:' {{ route('issue.store') }} ',
				type:'POST',
				dataType:'json',
				data:{
					"_token":" {{ csrf_token() }} ",
					employee_id:employee_id,
					inventory_id:inventory_id,
					return_date:return_date,
				},
				success:function(response){
					console.log(response);
					swal.fire("Done!", "Item Issued", "success");
				},
				error:function(response){
					console.log(response);
				}

			});

		});

		function pendingFunction(id)
		{
			// console.log(id);

			$.ajax({

				url:' {{ route('pending.issued') }} ',
				type: 'POST',
				dataType:'json',
				data:{
						"_token":" {{ csrf_token() }} ",
						id:id,
				},
				success:function(response)
				{
					console.log(response);
				},
				error:function(msg)
				{
					console.log(msg);
				}

			});

		}


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
