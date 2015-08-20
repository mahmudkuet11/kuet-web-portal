@extends('layouts.main')

@section('content')
	@include('admin.navbar')

<div class="container">
	<div class="row">
		<h1 style="text-align:center">Offer Courses</h1>
		<div class="col-md-6">
			<h3>Select Students</h3>
			<hr>
			<div class="row">
				<div class="col-md-4">
					<label for="batch">Enter Batch</label>
					<input type="text" class="form-control" placeholder="eg. 2011" id="batch">
				</div>
				<div class="col-md-4">
					<label for="department">Select Department</label>
					<select name="" id="department" class="form-control">
						<option value="">Select one</option>
						<option value="CE">CE</option>
						<option value="EEE">EEE</option>
						<option value="ME">ME</option>
						<option value="CSE">CSE</option>
						<option value="ECE">ECE</option>
						<option value="IPE">IPE</option>
						<option value="LE">LE</option>
						<option value="TE">TE</option>
						<option value="BECM">BECM</option>
						<option value="URP">URP</option>
						<option value="BME">BME</option>
					</select>
				</div>
				<div class="col-md-4">
					<br>
					<button class="btn btn-primary" id="search_student">Search</button>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-4"><div class="checkbox"><label><input type="checkbox" id="check_all"> Check All</label></div></div>
				<div class="col-md-4"><div class="checkbox"><label><input type="checkbox" id="uncheck_all"> Uncheck All</label></div></div>
			</div>
			<hr>
			<div class="row" id="students_list">

			</div>
		</div>
		<div class="col-md-6">
			<h3>Select Courses</h3>
			<hr>
			<div class="row" id="course_list">
				<?php
					$courses = DB::table('courses')->get();
					$i = 0;
					foreach ($courses as $course) {
						$i++;
						if($i == 1){
							echo '<div class="row">';
						}
						echo '<div class="col-md-4"><div class="checkbox"><label><input type="checkbox" value="'. $course->id .'"> <span style="color:orange">'. $course->code .'</span> - '. $course->name .'</label></div></div>';
						if($i == 3){
							echo '</div>';
							$i = 0;
						}
					}
				?>
				
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12"><hr></div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<label for="year">Select Year</label>
			<select name="" id="year" class="form-control">
				<option value="1">First Year</option>
				<option value="2">Second Year</option>
				<option value="3">Third Year</option>
				<option value="4">Fourth Year</option>
			</select>
		</div>

		<div class="col-md-4">
			<label for="term">Select Term</label>
			<select name="" id="term" class="form-control">
				<option value="first">First Term</option>
				<option value="second">Second Term</option>
				<option value="backlog">Backlog</option>
			</select>
		</div>

		<div class="col-md-4">
			<label for="term">Session</label>
			<input type="text" class="form-control" placeholder="eg. 2011-2012" id="session">
		</div>

	</div>

	<div class="row">
		<div class="col-md-2 col-md-offset-10">
			<br><br>
			<button class="btn btn-primary" id="submit_course_offer">Submit</button>
		</div>
	</div>
	<div class="row" id="success_msg" style="display:none">
		<div class="col-md-6 col-md-offset-3">
			<div class="alert alert-dismissible alert-success">
			  <button type="button" class="close" data-dismiss="alert">×</button>
			  Course Registration is successfull.
			</div>
		</div>
	</div>
	<div class="row" id="error_msg" style="display:none">
		<div class="col-md-6 col-md-offset-3">
			<div class="alert alert-dismissible alert-danger">
			  <button type="button" class="close" data-dismiss="alert">×</button>
			  Course Registration is successfull.
			</div>
		</div>
	</div>



	<br><br><br><br><br>
</div>

{{ HTML::script('js/offerCourse.js') }}
@stop