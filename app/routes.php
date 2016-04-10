<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(array('before'	=>	'login'), function(){
	Route::get('/', array(
		'as'	=>	'home',
		'uses'	=>	'HomeController@getHome'
		));
});
Route::get('/login', array(
		'as'	=>	'getLogin',
		'uses'	=>	'AccountController@getLogin'
	));
Route::post('/login', array(
		'as'	=>	'postLogin',
		'uses'	=>	'AccountController@postLogin'
	));
Route::get('/logout', array(
		'as'	=>	'getLogout',
		'uses'	=>	'AccountController@getLogout'
	));

/*
*	Admin route
*/
Route::group(array('before'	=>	'admin'), function(){
	Route::get('/admin', array(
		'as'	=>	'getAdminDashboard',
		'uses'	=>	'AdminController@getAdminDashboard'
		));
	Route::get('/student/new', array(
		'as'	=>	'getcreateNewStudent',
		'uses'	=>	'AdminController@getcreateNewStudent'
		));
	Route::post('/student/new', array(
		'as'	=>	'postcreateNewStudent',
		'uses'	=>	'AdminController@postcreateNewStudent'
		));
	Route::get('/teacher/new', array(
		'as'	=>	'getcreateNewTeacher',
		'uses'	=>	'AdminController@getcreateNewTeacher'
		));
	Route::post('/teacher/new', array(
		'as'	=>	'postcreateNewTeacher',
		'uses'	=>	'AdminController@postcreateNewTeacher'
		));
	Route::get('/course/new', array(
		'as'	=>	'getcreateNewCourse',
		'uses'	=>	'AdminController@getcreateNewCourse'
		));
	Route::post('/course/new', array(
		'as'	=>	'postcreateNewCourse',
		'uses'	=>	'AdminController@postcreateNewCourse'
		));
	Route::get('/assign-adviser', array(
		'as'	=>	'getAssignAdviser',
		'uses'	=>	'AdminController@getAssignAdviser'
		));
	Route::post('/assign-adviser', array(
		'as'	=>	'postAssignAdviser',
		'uses'	=>	'AdminController@postAssignAdviser'
		));

});

/*
*	query routes
*/
Route::get('/get/students/{batch}/{department}', array(
		'as'	=>	'getStudents',
		'uses'	=>	'QueryController@getStudents'
	));

/*
*	Student Route
*/

Route::group(array('before'	=>	'student'), function(){
	Route::get('/student', array(
			'as'	=>	'getStudentDashboard',
			'uses'	=>	'StudentController@getStudentDashboard'
		));
	Route::get('/student/profile/update', array(
			'as'	=>	'getUpdateStudentProfile',
			'uses'	=>	'StudentController@getUpdateStudentProfile'
		));
	Route::post('/student/profile/update', array(
			'as'	=>	'postUpdateStudentProfile',
			'uses'	=>	'StudentController@postUpdateStudentProfile'
		));
	Route::get('/student/course/registration', array(
			'as'	=>	'getCourseRegistration',
			'uses'	=>	'StudentController@getCourseRegistration'
		));
	Route::get('/student/course/offered', array(
			'as'	=>	'ajaxOfferedCourse',
			'uses'	=>	'QueryController@ajaxOfferedCourse'
		));
	Route::get('/student/course-registration-status', array(
			'as'	=>	'ajaxGetCourseRegistrationStatus',
			'uses'	=>	'QueryController@ajaxGetCourseRegistrationStatus'
		));
	Route::post('/student/forward', array(
			'as'	=>	'postForwardToAdviser',
			'uses'	=>	'StudentController@postForwardToAdviser'
		));
});

/*
*	Teachers Route
*/
Route::group(array('before'	=>	'teacher'), function(){
	Route::get('/teacher/dashboard', array(
			'as'	=>	'getTeacherDashboard',
			'uses'	=>	'TeacherController@getTeacherDashboard'
		));
	Route::get('/teacher/profile/update', array(
			'as'	=>	'getUpdateTeachersProfile',
			'uses'	=>	'TeacherController@getUpdateTeachersProfile'
		));
	Route::post('/teacher/profile/update', array(
			'as'	=>	'postUpdateTeachersProfile',
			'uses'	=>	'TeacherController@postUpdateTeachersProfile'
		));
});



