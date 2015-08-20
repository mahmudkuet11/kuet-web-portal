@extends('layouts.main')

@section('content')
	@include('admin.navbar')

<div class="container">
	<div class="row">
		<div class="col-md-6">
			<form class="form-horizontal" action="{{ URL::route('postcreateNewCourse') }}" method="post">
			  <fieldset>
			    <legend>Create New Course</legend>
				<?php

					if(Session::has('error')){ ?>
						<div class="alert alert-dismissible alert-danger">
						  <button type="button" class="close" data-dismiss="alert">×</button>
						  <?php echo Session::get('error'); ?>
						</div>
					<?php }

					if(Session::has('success')){ ?>
						<div class="alert alert-dismissible alert-success">
						  <button type="button" class="close" data-dismiss="alert">×</button>
						  <?php echo Session::get('success'); ?>
						</div>
					<?php }

				?>
			    <div class="form-group">
			      <label for="code" class="col-md-2 control-label">Couser Code</label>
			      <div class="col-md-10">
			        <input type="text" class="form-control" id="code" placeholder="Course Code" name="code">
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="name" class="col-md-2 control-label">Couser Name</label>
			      <div class="col-md-10">
			        <input type="text" class="form-control" id="name" placeholder="Course Name" name="name">
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="credit" class="col-md-2 control-label">Credit</label>
			      <div class="col-md-10">
			        <input type="text" class="form-control" id="credit" placeholder="eg. 1.50" name="credit">
			      </div>
			    </div>

			    <div class="form-group">
			      <div class="col-md-10 col-md-offset-2">
			        <button type="submit" class="btn btn-primary">Create Course</button>
			      </div>
			    </div>
			  </fieldset>
			</form>

		</div>
	</div>
</div>

@stop