<?php

	class DepartmentController extends BaseController {
		/*
		* Get Add Department Form
		*/
		public function getAddDepartment() {
			return 	View::make('admin.add-department');
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
				$department_name 	= Input::get('department');

				//Add to departments table
				$department = Department::create(array(
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
			return 	View::make('admin.manage-department')
					->with('departments', Department::orderBy('department')->get());
		}

	}