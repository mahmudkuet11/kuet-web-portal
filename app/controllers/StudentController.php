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
}