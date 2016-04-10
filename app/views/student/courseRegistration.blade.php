@extends('layouts.main')

@section('content')
	@include('student.navbar')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Course Registration</h1>
				
				<div class="row">
					<div class="col-md-5">
						<label for="select_year">Select Year</label>
						<select name="" id="" class="form-control">
							<option value="1">First Year</option>
							<option value="2">Second Year</option>
							<option value="3">Third Year</option>
							<option value="4">Fourth Year</option>
						</select>
					</div>
					<div class="col-md-5">
						<label for="select_year">Select Term</label>
						<select name="" id="" class="form-control">
							<option value="1">1st</option>
							<option value="2">2nd</option>
							<option value="backlog">Backlog</option>
							<option value="special_backlog">Special Backlog</option>
						</select>
					</div>
					<div class="col-md-2">
						<br>
						<button class="btn btn-primary">Show</button>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6 course_registration">
						<div class="available_courses">
							<div class="course">
								<h3>Compiler Design</h3>
								Code: <b>CSE 1207</b><br>
								Credit: <b>3.00</b>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	{{ HTML::script('js/studentCourse.js') }}

@stop