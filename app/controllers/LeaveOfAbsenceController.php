<?php

class LeaveOfAbsenceController extends BaseController {
	
	public function getForm() {
		return 	View::make('online-forms.leave-of-absence', array('pageTitle' => 'Leave of Absence'))
				->with("departments", Department::orderBy('department')->lists('department', 'department_id'));
	}

}
