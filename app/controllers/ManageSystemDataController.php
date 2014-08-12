<?php

	class ManageSystemDataController extends BaseController {
		/*
		* Get Add Department Form
		*/
		public function getAddDepartment() {
			$generated_id = $this->generateDepartmentID();
			return 	View::make('admin.add-department', array('pageTitle' => 'Add Department', 'generatedID' => $generated_id));
		}

		public function postAddDepartment() {
			$validator = Validator::make(Input::all(),
				array(
					'department' => 'required|max:20|min:5|unique:departments'
				)
			);

			if($validator->fails()) {
				//Redirect to signin page
				return 	Redirect::route('admin-add-department')
						->withErrors($validator)
						->withInput();
			}
			else {
				//Create department
				$department_id 	= Input::get('department_id');
				$department_name 	= Input::get('department');

				//Add to departments table
				$department = Department::create(array(
					'department_id' => $department_id,
					'department' => $department_name,
					'status' => 1
				));

				if($department) {
					return 	Redirect::route('admin-add-department')
							->with('global', 'Department Added!');
				}
				else {
						return 	Redirect::route('admin-add-department')
								->with('global', 'Failed to add department');
				}

			}
		}

		public function getManageDepartment() {
			return 	View::make('admin.manage-department', array('pageTitle' => 'Manage Departments'))
					->with('departments', Department::orderBy('department')->get());
		}

		public function getManageEmployee() {
			return 	View::make('admin.manage-employee', array('pageTitle' => 'Manage Employees'))
					->with('employees', Employee::orderBy('last_name')->get());
		}

		public function getDeleteDepartment($departmentName) {
			$department = Department::where('department', $departmentName)->first();

			$msg = "";
			if($department->count()) {
				$department->delete();
				$msg = $departmentName . " department deleted!";
			}
			else {
				$msg = 'Failed to delete department ' . $departmentName;
			}

			return 	Redirect::route('admin-manage-department')
						->with('global', $msg);
		}

		public function getDeactiveEmployeeAccount($username) {
			$employee = Employee::where('username', $username)->first();

			$msg = "";
			if($employee->count()) {
				$employee->delete();
				$msg = "Account of employee with username " . $username . " is deactivated!";
			}
			else {
				$msg = 'Failed to deactivate account of employee with username ' . $username;
			}

			return 	Redirect::route('admin-manage-employee')
					->with('global', $msg);
		}


		//code taken from: http://www.lost-in-code.com/programming/php-code/php-random-string-with-numbers-and-letters/
		public function generateRandomString($length) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
			$string = '';
		    for ($p = 0; $p < $length; $p++) {
		        $string .= $characters[mt_rand(0, strlen($characters) -1)];
		    }
		    return $string;
		}

		public function generateDepartmentID() {
			$generated_id = "D-" . strtoupper($this->generateRandomString(4));

			$department_exists = Department::where('department_id', $generated_id)->get();

			if($department_exists->count()) {
				generateID();
			}
			else{
				return $generated_id;
			}
		}

	}