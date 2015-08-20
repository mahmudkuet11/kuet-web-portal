<?php
class QueryController extends BaseController{
	public function getStudents($batch, $department){
		return json_encode(DB::table('students')->where('batch', $batch)->Where('department', $department)->get());
	}
}