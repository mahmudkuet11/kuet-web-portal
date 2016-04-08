@extends('layouts.main')

@section('content')
	@include('student.navbar')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h3>Course Registration</h3>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group col-md-5">
						      <label for="year" class="col-md-4 control-label">Select Year</label>
						      <div class="col-md-7">
								<select name="" class="form-control" id="year">
						          <option value="1">First Year</option>
						          <option value="2">Second Year</option>
						          <option value="3">Third Year</option>
						          <option value="4">Fourth Year</option>
						        </select>
						      </div>
						</div>
						<div class="form-group col-md-5">
						      <label for="term" class="col-md-4 control-label">Select Term</label>
						      <div class="col-md-7">
								<select class="form-control" id="term">
						          <option value="first">First Term</option>
						          <option value="second">Second Term</option>
						          <option value="backlog">Backlog</option>
						        </select>
						      </div>
						</div>
						<div class="form-group col-md-2">
						    <button class="btn btn-primary" id="show_course">Show</button>
						</div>
					</div>
				</div>
				<br><br>
				<table class="table table-striped" id="course">
					
				</table>
				<button class="btn btn-primary" id="forward_button">Forward to adviser</button>
			</div>
		</div>
	</div>

	{{ HTML::script('js/studentCourse.js') }}

@stop