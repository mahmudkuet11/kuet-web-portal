<?php

class TestController extends BaseController{
	public function sendMail(){
		$data = array();
		Mail::queue('emails.courseRegistration', array('name'	=>	'Mahmud'), function($message)
		{
		    $message->to('mahmudkuet11@gmail.com', 'Raju vai')->subject('Welcome!');
		});
		return 1;
	}
}