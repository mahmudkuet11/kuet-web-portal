<?php

class TeacherController extends BaseController{
	public function getTeacherDashboard(){
		return View::make('teacher.dashboard');
	}

	public function getUpdateTeachersProfile(){
		return View::make('teacher.updateProfile');
	}

	public function postUpdateTeachersProfile(){
		try{
			$full_name = Input::get('full_name');
			$email = Input::get('email');
			$file = Input::file('image');
			$path = 'img/gravatar.png';
			if($file){
				$destinationPath = 'uploads';
				$filename = time() . $file->getClientOriginalName();
				$extension =$file->getClientOriginalExtension(); 
				Input::file('image')->move($destinationPath, $filename);
				$path = 'uploads/' . $filename;
			}
			DB::table('teachers')->where('user_id', Session::get('user_id'))->update(array(
					'full_name'	=>	$full_name,
					'email'		=>	$email,
					'image'		=>	$path
				));
			Session::flash('success', 'Your profile is updated.');
			return Redirect::route('getUpdateTeachersProfile');
		}catch(\Exception $e){
			Session::flash('error', 'Sorry, there is a problem. Please try again.');
			return Redirect::route('getUpdateTeachersProfile');
		}
	}
}