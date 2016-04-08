<?php

class AdminController extends BaseController{
	public function getAdminDashboard(){
		return View::make('admin.dashboard');
	}

	public function getcreateNewStudent(){
		return View::make('admin.newStudent');
	}
	public function postcreateNewStudent(){
		$roll = Input::get('roll');
		$password = Input::get('password');
		$department = Input::get('department');
		$batch = Input::get('batch');

		if($roll == '' || $password == '' || $department == '' || $batch == ''){
			Session::flash('error', 'You must enter all the informations correctly');
			return Redirect::route('getcreateNewStudent');
		}else{
			DB::beginTransaction();
			try{
				DB::table('users')->insert(array(
						'username'	=>	$roll,
						'password'	=>	Hash::make($password),
						'usertype'	=>	'student'
					));
				DB::table('students')->insert(array(
						'roll'			=>	$roll,
						'department'	=>	$department,
						'batch'			=>	$batch
					));
				DB::commit();
				Session::flash('success', 'Student (#'. $roll .') has been added successfully');
				return Redirect::route('getcreateNewStudent');
			}catch(\Exception $e){
				DB::rollback();
				Session::flash('error', 'Sorry. We could not add the student. Please try again');
				return Redirect::route('getcreateNewStudent');
			}
		}

	}

	public function getcreateNewTeacher(){
		return View::make('admin.newTeacher');
	}
	public function postcreateNewTeacher(){
		$username = Input::get('username');
		$password = Input::get('password');

		DB::beginTransaction();
		try{
			$id = DB::table('users')->insertGetId(array(
					'username'	=>	$username,
					'password'	=>	Hash::make($password),
					'usertype'	=>	'teacher'
				));
			DB::table('teachers')->insert(array(
					'user_id'	=>	$id
				));
			DB::commit();
			Session::flash('success', 'Teacher has been added successfully!!!');
			return Redirect::route('getcreateNewTeacher');
		}catch(\Exception $e){
			DB::rollback();
			Session::flash('error', 'Sorry. Please try again!!!');
			return Redirect::route('getcreateNewTeacher');
		}
	}

	public function getcreateNewCourse(){
		return View::make('admin.newCourse');
	}
	public function postcreateNewCourse(){
		$code = Input::get('code');
		$name = Input::get('name');
		$credit = Input::get('credit');

		DB::beginTransaction();
		try{
			DB::table('courses')->insert(array(
					'code'	=>	$code,
					'name'	=>	$name,
					'credit'=>	$credit
				));
			DB::commit();
			Session::flash('success', 'Course has been added successfully!!!');
			return Redirect::route('getcreateNewCourse');
		}catch(\Exception $e){
			DB::rollback();
			Session::flash('error', 'Sorry. Please try again!!!');
			return Redirect::route('getcreateNewCourse');
		}
	}

	public function getAssignAdviser(){
		return View::make('admin.assignAdviser');
	}
	public function postAssignAdviser(){
		$student_id = Input::get('student');
		$teacher_id = Input::get('adviser');

		DB::beginTransaction();
		try{
			DB::table('students')->where('id', $student_id)->update(array(
					'adviser_id'	=>	$teacher_id
				));
			DB::commit();
			Session::flash('success', 'Adviser has been assigned successfully!!!');
			return Redirect::route('getAssignAdviser');
		}catch(\Exception $e){
			DB::rollback();
			Session::flash('error', 'Sorry. Please try again!!!');
			return Redirect::route('getAssignAdviser');
		}
	}

	public function getOfferCourses(){
		return View::make('admin.offerCourses');
	}

	public function postOfferCourses(){
		$student_id 	= Input::get('students');
		$courses 		= Input::get('courses');
		$year 			= Input::get('year');
		$term 			= Input::get('term');
		$session 		= Input::get('session');
		
		$students = json_decode($student_id);
		DB::beginTransaction();
		try{
			foreach ($students as $student) {
				DB::table('course_registrations')->insert(array(
						'student_id'					=>	$student,
						'year'							=>	$year,
						'term'							=>	$term,
						'session'						=>	$session,
						'courses'						=>	$courses,
						'course_registration_status'	=>	'student'
					));


			}
			DB::commit();
			
			foreach ($students as $student) {
					$student_info = DB::table('students')->where('id', $student)->first();
					$full_name = $student_info->full_name;
					$email = $student_info->email;
					if($email == null || $full_name == null){

					}else{
						Mail::queue('emails.courseRegistration', array('name'	=>	$full_name), function($message) use ($full_name, $email)
						{
						    $message->to($email, $full_name)->subject('Course Registration');
						});
					}
					
			}

			return 1;
		}catch(\Exception $e){
			DB::rollback();
			return 0;
		}


		
	}
}