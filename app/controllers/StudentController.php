<?php

class StudentController extends BaseController{
	public function getStudentDashboard(){
		return View::make('student.dashboard');
	}

	public function getUpdateStudentProfile(){
		return View::make('student.updateProfile');
	}

	public function postUpdateStudentProfile(){
		$full_name = Input::get('full_name');
		$email = Input::get('email');

		DB::beginTransaction();
		try{
			$roll = DB::table('users')->where('id', Session::get('user_id'))->first()->username;
			DB::table('students')->where('roll', $roll)->update(array(
					'full_name'	=>	$full_name,
					'email'	=>	$email
				));

			DB::commit();
			Session::flash('success', 'Your profile has been updated.');
			return Redirect::route('getUpdateStudentProfile');
		}catch(\Exception $e){
			DB::rollback();
			Session::flash('error', 'Sorry.We could not update your profile.Try again');
			return Redirect::route('getUpdateStudentProfile');
		}
	}

	public function getCourseRegistration(){
		return View::make('student.courseRegistration');
	}

	public function postForwardToAdviser(){
		$year = Input::get('year');
		$term = Input::get('term');

		$user_id = Session::get('user_id');
		$roll = DB::table('users')->where('id', $user_id)->first()->username;
		$student_id = DB::table('students')->where('roll', $roll)->first()->id;
		$course_registration = DB::table('course_registrations')
									->where('student_id', $student_id)
									->where('year', $year)
									->where('term', $term)
									->where('course_registration_status', 'student')
									->first();
		if($course_registration == null){
			return '0';
		}else{
			$status = DB::table('course_registrations')
				->where('student_id', $student_id)
				->update(array(
					'course_registration_status'	=>	'adviser'
				));
			if($status == 1){
				$info = "Your course registration request has been sent to the adviser for approval.";
				$student = DB::table('students')->where('id', $student_id)->first();
				$email = $student->email;
				$full_name = $student->full_name;
				if($email != null){
					if($full_name == null){
						$full_name = "";
					}
					Mail::send('emails.info', array('info'	=>	$info), function($message) use ($email, $full_name)
					{
					    $message->to($email, $full_name)->subject('Course Registration');
					});
				}
				
				return 1;
			}else{
				return 0;
			}
		}
	}
}