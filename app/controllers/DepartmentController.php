<?php

	class DepartmentController extends BaseController {
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
					'department' => 'required|max:20|min:2|unique:departments'
				)
			);

			if($validator->fails()) {
				//Redirect to signin page
				return 	Redirect::route('admin-department-add')
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
					return 	Redirect::route('admin-department-add')
							->with('global', 'Department Added!');
				}
				else {
						return 	Redirect::route('admin-department-add')
								->with('global', 'Failed to add department');
				}

			}
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

		public function getEditDepartment($departmentID) {

			$department = Department::where('department_id', $departmentID)->first();
			$department_head_username = $this->getHeadEmployeeUsername($departmentID);

			$dept_members = Employee::where('department_id', $departmentID)->get();

			return 	View::make('profile.department', array('pageTitle' => 'Edit Department Information'))
					->with('department', $department)
					->with('departmentHeadUsername', $department_head_username)
					->with('employees', Employee::where('department_id', $departmentID))
					->with('dept_members', $dept_members);
		}

		public function postEditDepartment($departmentID) {
			$validator = Validator::make(Input::all(),
				array(
					'department' => 'required|max:20|min:2'
				)
			);

			if($validator->fails()) {
				return 	Redirect::route('admin-department-edit', array('departmentID' => $departmentID))
						->withErrors($validator)
						->withInput();
			}
			else {
				$department_name 	= Input::get('department');
				$employee_username	= Input::get('department_head');

				//Get department
				$department_name_exists = Department::where('department_id', '!=', $departmentID)->where('department', $department_name)->first();
				$department = Department::where('department_id', $departmentID)->first();

				if($department->count() && !($department_name_exists)) {
					$department->department = $department_name;

					//check if saving department details is successful
					if($department->save()){

						//check if there's already an existing department head
						$head_employee_exists = Employee::where('department_id', $departmentID)->where('position', 1)->first();
						if($head_employee_exists) {
							$head_employee_exists->position = 0;
							$head_employee_exists->save();
						}

						//check if there's an input for employee name
						$employee = Employee::where('username', $employee_username)->first();
						if($employee) {
							$employee->position = 1;
							$employee->department_id = $departmentID;

							//check if saving employee data is successful
							if($employee->save()) {
								$return_msg ="Department information is updated!";
							}
							else{
								$return_msg = "Failed to update department information! Error on updating position of head employee";
							}
						}
						else {
							$return_msg ="Department information is updated!";
						}
					}
					else {						
						$return_msg = "Failed to update department information! Error on saving the changes.";
					}
				}
				else {
					$return_msg = 'Failed to update the department information! Error on finding the department or department with similar name already exists!';
				}

				return 	Redirect::route('admin-department-edit', array('departmentID' => $departmentID))
						->with('global', $return_msg);
			}
		}

		/*
		* / Get Head of department
		*/
	    public function getHeadEmployeeUsername($departmentID) {
	    	$employee = Employee::departmentID($departmentID)->head()->first();

	    	if($employee){
	    		$employee_id = e($employee->username);
	    		return $employee_id;
	    	}
	    	else {
	    		return "";
	    	}
	    }

		public function generateDepartmentID() {
			$generated_id = "D-" . strtoupper(RandomNumberGenerator::generateRandomString(4));

			$department_exists = Department::where('department_id', $generated_id)->get();

			if($department_exists->count()) {
				generateDepartmentID();
			}
			else{
				return $generated_id;
			}
		}

	}