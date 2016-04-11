<?php
class QueryController extends BaseController{
	public function getStudents($batch, $department){
		return json_encode(DB::table('students')->where('batch', $batch)->Where('department', $department)->get());
	}

	public function ajaxOfferedCourse(){
		$roll = DB::table('users')->where('id', Session::get('user_id'))->first()->username;
		$student_id = DB::table('students')->where('roll', $roll)->first()->id;
		$year = Input::get('year');
		$term = Input::get('term');
		$row = DB::table('course_registrations')
				->where('student_id', $student_id)
				->where('year', $year)
				->where('term', $term)
				->where('course_registration_status', 'student')
				->first();
		if($row){
			$courses = json_decode($row->courses);
		}else{
			return 404;
		}
		
		$result = array();
		foreach ($courses as $course) {
			$c = DB::table('courses')->where('id', $course)->first();
			$code = $c->code;
			$title = $c->name;
			$credit = $c->credit;
			array_push($result, array(
					'code'		=>	$code,
					'title'		=>	$title,
					'credit'	=>	$credit
				));
		}
		return json_encode($result);
	}

	public function ajaxGetCourseRegistrationStatus(){
		$roll = DB::table('users')->where('id', Session::get('user_id'))->first()->username;
		$student_id = DB::table('students')->where('roll', $roll)->first()->id;
		$year = Input::get('year');
		$term = Input::get('term');
		$courses = DB::table('course_registrations')
				->where('student_id', $student_id)
				->where('year', $year)
				->where('term', $term)
				->first();
		if($courses){
			return $courses->course_registration_status;
		}else{
			return 404;
		}
	}

	public function getAvailableCourses(){
		/*
		*	possible options are: 1/2/3/4
		*/
		$year = Input::get('year');
		/*
		*	possible options are:
		*	First Term - 1
		*	Second Term - 2
		*/
		$term = Input::get('term'); 
		$courses = DB::select(DB::raw("select * from courses where code like '%". $year . $term ."__%'"));
		return json_encode($courses);
	}
}