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
							<input type="submit" name="submit" class="btn btn-success pl-4 pr-4" value="INSERT ROLE">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@stop
