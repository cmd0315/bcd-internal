<?php

	class ProfileController extends BaseController {

		public function employee($username) {
			$employee = Employee::where('username', $username);

			if($employee->count()){
				$employee = $employee->first();

				return 	View::make('profile.employee')
						->with('employee', $employee)
						->with('departments', Department::orderBy('department')->get());
			}

			return App::abort(400);
		}

		public function postEmployee($username) {
			$validator = Validator::make(Input::all(), 
				array(
					'position' => 'required',
					'department' => 'required'
				)
			);

			if($validator->fails()) {
				return 	Redirect::route('profile-employee', array('username' => $username) )
						->withErrors($validator)
						->withInput();
			}
			else {
				//Create employee account
				$department_id 	= Input::get('department');
				$position 	= Input::get('position');

				//Update employee table
				$employee = Employee::where('username', $username)->first();

				$employee->department_id = $department_id;
				$employee->position = $position;


				if($employee->save()) {
					return Redirect::route('profile-employee', array('username' => $username) )
							->with('global', 'Employee account updated!');
				}
				else {
					return 	Redirect::route('profile-employee', array('username' => $username) )
							->with('global', 'Failed to update employee account!');
				}
			}
		}

		public function postDeleteEmployee($username) {
			return Redirect::route('/');
		}
	}