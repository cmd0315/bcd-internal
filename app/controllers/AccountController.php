<?php

	class AccountController extends BaseController {

		/* viewing the signin form */
		public function getSignIn() {
			return View::make('account.signin', array('pageTitle' => 'Sign In'));
		}

		/* submitting the signin form */
		public function postSignIn() {
			$validator = Validator::make(Input::all(),
				array(
					'username' => 'required|max:20|min:5|',
					'password' => 'required'
				)
			);

			if($validator->fails()) {
				//Redirect to signin page
				return 	Redirect::route('account-sign-in')
						->withErrors($validator)
						->withInput();
			}
			else {
				$remember = (Input::has('remember')) ? true : false;

				$auth = Auth::attempt(array(
					'username' => Input::get('username'),
					'password' => Input::get('password'),
					'status' => 1
				), $remember);

				if($auth){
					//Redirect to intended page
					return Redirect::intended('/');
				}
				else {
					return  Redirect::route('account-sign-in')
							->with('global', 'Wrong username or password');
				}
			}

		}

		/* sign out */
		public function getSignOut() {
			Auth::logout();
			return Redirect::route('home');
		}


		/* viewing the form */
		public function getCreate() {
			return 	View::make('account.create', array('pageTitle' => 'Create Employee Account'))
					->with('departments', Department::orderBy('department')->lists('department', 'department_id'));
		}

		/* submitting the form */
		public function postCreate() {
			$validator = Validator::make(Input::all(), 
				array(
					'username' => 'required|max:20|min:5|unique:accounts',
					'password' => 'required|max:50|min:6',
					'password_again' => 'required|same:password',
					'first_name' => 'required|max:50',
					'middle_name' => 'required|max:50',
					'last_name' => 'required|max:50',
					'email' => 'required|max:50|email|unique:employees',
					'mobile' => 'max:15|min:11',
					'position' => 'required',
					'department' => 'required'
				)
			);

			if($validator->fails()) {
				return 	Redirect::route('account-create')
						->withErrors($validator)
						->withInput();
			}
			else {
				//Create employee account
				$username 			= Input::get('username');
				$password 			= Input::get('password');
				$first_name 		= Input::get('first_name');
				$middle_name 		= Input::get('middle_name');
				$last_name 			= Input::get('last_name');
				$email 				= Input::get('email');
				$mobile 			= Input::get('mobile');
				$department_id 		= Input::get('department');
				$department_name 	= Department::where('department_id', $department_id)->pluck('department');
				$position 			= Input::get('position');


				$existingEmployee = Employee::departmentID($department_id)->head()->get();

				
					//Add to accounts table
					$account = Account::create(array(
						'username' => $username,
						'password' => Hash::make($password),
						'status' => 1
					));

					//Add to employees table
					$employee = Employee::create(array(
						'username' => $username,
						'first_name' => $first_name,
						'middle_name' => $middle_name,
						'last_name' => $last_name,
						'email' => $email,
						'mobile' => $mobile,
						'department_id' => $department_id,
						'position' => $position
					));
					return 	Redirect::route('account-create')
							->with('global', 'Employee account successfully created!');
				

			}
		}

		/* viewing the change profile details form */
		public function getChangeProfileDetails() {
			return View::make('account.employee-account', array('pageTitle' => 'Change Account Details'));
		}

		/* submit change profile details form*/
		public function postChangeProfileDetails() {
			$validator = Validator::make(Input::all(), 
				array(
					'old_password' => 'required',
					'password' => 'required|max:50|min:6',
					'password_again' => 'required|same:password'
				) 
			);


			if($validator->fails()) {
				return 	Redirect::route('account-change-account-details')
						->withErrors($validator)
						->withInput();
			}
			else {
				$user 				= Account::find(Auth::user()->id);

				$old_password 		= Input::get('old_password');
				$new_password 		= Input::get('password');

				if(Hash::check($old_password, $user->getAuthPassword())) {
					$user->password = Hash::make($new_password);

					if($user->save()){
						return 	Redirect::route('home')
								->with('global', 'Password has been changed');
					}
				}
				else {
					return  Redirect::route('account-change-account-details')
							->with('global', 'Old password given does not match record');
				}
			}
			return  Redirect::route('account-change-account-details')
					->with('global', 'Cannot change password');
		}

	}