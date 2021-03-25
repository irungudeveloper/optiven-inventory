@extends('adminlte::page')
@section('title','Optiven Inventory')

@section('content_header')
	<h1>Brand</h1>
@stop

@section('content')
	<div class="row m-2 justify-content-center">
		<div class="col-md-10 col-lg-10 col-sm-12">
			<div class="card">
				<div class="card-header">
					<p class="text-center">BRAND FORM</p>
				</div>
				<div class="card-body">
					<form method="post">
						@csrf
						<div class="form-group row">
						    <label for="brand" class="col-sm-2 col-form-label">Brand Name</label>
						    <div class="col-sm-10">
						      <input type="hidden" name="brand_id" id="brand_id" value=" {{ $brand->id }} ">
						      <input type="text" class="form-control" id="brand" placeholder="Name" name="brand" value=" {{ $brand->name }} ">
						   </div>
						  </div>
						<div class="form-group text-center">
							<input type="submit" name="submit" class="btn btn-success pl-4 pr-4" value="UPDATE BRAND" id="create">
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
			var brand = $('#brand').val();
			var id = $('#brand_id').val();

			$.ajax({

					url:' {{ route("brand.update",'id') }} ',
					type:'PUT',
					data:{
							"_token":' {{ csrf_token() }} ',
							brand:brand,
							id:id,
					},
					dataType:'json',
					success:function(response)
					{
						console.log(response);
						if (response[0].response_code === 200) 
			   			{
							swal.fire("Done!", response[0].message, "success");
						} 
					}

			});

		});
	</script>
@stop
