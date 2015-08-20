@extends('layouts.main')

@section('content')
	@include('student.navbar')
	
	<div class="container">
		<div class="row">
			<div class="col-md-6">
<?php
	if(Session::has('success')){ ?>
		<div class="alert alert-dismissible alert-success">
		  <button type="button" class="close" data-dismiss="alert">×</button>
		  <?php echo Session::get('success'); ?>
		</div>
	<?php }
?>
<?php
	if(Session::has('error')){ ?>
		<div class="alert alert-dismissible alert-danger">
		  <button type="button" class="close" data-dismiss="alert">×</button>
		  <?php echo Session::get('error'); ?>
		</div>
	<?php }
?>

				<form class="form-horizontal" method="post" action="{{ URL::route('postUpdateStudentProfile') }}">
				  <fieldset>
				    <legend>Update Your Profile</legend>
				    <div class="form-group">
				      <label for="full_name" class="col-md-2 control-label">Full Name</label>
				      <div class="col-md-10">
				        <input name="full_name" type="text" class="form-control" id="full_name" placeholder="Full Name">
				      </div>
				    </div>

				    <div class="form-group">
				      <label for="email" class="col-md-2 control-label">Email</label>
				      <div class="col-md-10">
				        <input name="email" type="text" class="form-control" id="email" placeholder="Email">
				      </div>
				    </div>
				   
				    <div class="form-group">
				      <div class="col-md-10 col-md-offset-2">
				        <button type="reset" class="btn btn-default">Cancel</button>
				        <button type="submit" class="btn btn-primary">Submit</button>
				      </div>
				    </div>
				  </fieldset>
				</form>
			</div>
		</div>
	</div>

@stop