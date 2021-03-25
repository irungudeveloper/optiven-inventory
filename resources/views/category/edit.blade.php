@extends('adminlte::page')
@section('title','Optiven Inventory')

@section('content_header')
	<h1>Category</h1>
@stop

@section('right-sidebar')
	<p>Content</p>
@stop

@section('content')
	<div class="row m-2 justify-content-center">
		<div class="col-md-10 col-lg-10 col-sm-12">
			<div class="card">
				<div class="card-header">
					<p class="text-center">CATEGORY FORM</p>
				</div>
				<div class="card-body">
					<form method="post">
						@csrf
						<div class="form-group row">
						    <label for="category" class="col-sm-2 col-form-label">Category Name</label>
						    <div class="col-sm-10">
						    	<input type="hidden" name="cat_id" id="cat_id" value=" {{ $category->id }} ">
						      <input type="text" class="form-control" id="category" placeholder="Name" name="category" value=" {{ $category->name }} ">
						   </div>
						  </div>
						<div class="form-group text-center">
							<input type="button" name="submit" class="btn btn-success pl-4 pr-4" value="UPDATE CATEGORY" id="create">
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
			    var category = $('#category').val();
			    var id = $('#cat_id').val();
			   // console.log(id);

			   $.ajax(
			   {

			   		url:' {{ route("category.update",'id') }} ',
			   		type:'PUT',
			   		data:{

			   				"_token":" {{ csrf_token() }} ",
			   				category:category,
			   				id:id,
			   		},
			   		dataType:'json',
			   		success:function(response)
			   		{
			   			console.table(response);
			  	 		// 		if (response[0].response_code === 200) 
			   			// 			{
						// 	swal.fire("Done!", response[0].message, "success");
						// } 
			   		},
			   		error:function(msg)
			   		{
			   			console.table(msg);
			   		}
			   });

			});
	</script>
@stop
