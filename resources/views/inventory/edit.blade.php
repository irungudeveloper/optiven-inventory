@extends('adminlte::page')
@section('title','Optiven Inventory')

@section('content_header')
	
@stop

@section('content')
	<div class="row m-2 justify-content-center">
		<div class="col-md-10 col-lg-10 col-sm-12">
			<div class="card">
				<div class="card-header">
					<p class="text-center">UPDATE INVENTORY</p>
				</div>
				<div class="card-body">
					<form method="post">
						@csrf
						 <div class="form-row">
							    <div class="form-group col-md-6">
							      <label for="serial_number">Serial Number</label>
							      <input type="hidden" name="inventory_id" id="inventory_id" value=" {{ $inventory->id }} ">
							      <input type="text" class="form-control" id="serial_number" placeholder="Serial Number" value=" {{ $inventory->serial_number }} ">
							    </div>
							    <div class="form-group col-md-6">
							      <label for="model_number">Model Number</label>
							      <input type="text" class="form-control" id="model_number" placeholder="Model Number" value=" {{ $inventory->model_number }} ">
							    </div>
							  </div>
						 <div class="form-row">
							    <div class="form-group col-md-6">
							      <label for="category">Category</label>
							      <select name="category" id="category" class="form-control">
							      	<option value=" {{ $inventory->category_id }} " > {{ $inventory->category->name }} </option>
							      	<option>
							      	------------------------------------------------------------------------------------------------------------------------
							      	</option>
							      	@foreach($category as $data)
							      		<option value=" {{ $data->id }} "> {{ $data->name }} </option>
							      	@endforeach
							      </select>
							    </div>
							    <div class="form-group col-md-6">
							      <label for="brand">Brand</label>
							      <select name="brand" id="brand" class="form-control">
							      	<option value=" {{ $inventory->brand_id }} "> {{ $inventory->brand->name }} </option>
							      	<option>
							      	------------------------------------------------------------------------------------------------------------------------
							      	</option>
							      	@foreach($brand as $data)
							      		<option value=" {{ $data->id }} "> {{ $data->name }} </option>
							      	@endforeach
							      </select>
							    </div>
							  </div>
							<div class="form-group">
								<label for="description">Description</label>
								<textarea class="form-control" id="description" name="description">{{ $inventory->description }}
								</textarea>
							</div>
						<div class="form-group text-center">
							<input type="submit" name="submit" class="btn btn-success pl-4 pr-4" value="UPDATE INVENTORY" id="create">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@stop

@section('js')
	<script type="text/javascript">
		$('#create').on('click',function(e){
			e.preventDefault();
			console.log('prevented');

			var serial_number = $('#serial_number').val();
			var model_number = $('#model_number').val();
			var category_id = $('#category').val();
			var brand_id = $('#brand').val();
			var description = $('#description').val();
			var id = $('#inventory_id').val();

			// console.log(description);

			$.ajax({
					url:' {{ route("inventory.update",'id') }} ',
					type:'PUT',
					data:{
						"_token":" {{ csrf_token() }} ",
						serial_number:serial_number,
						model_number:model_number,
						category_id:category_id,
						brand_id:brand_id,
						description:description,
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
