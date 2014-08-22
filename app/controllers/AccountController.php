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
					return Redirect::intended(URL::route('dashboard'));
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
					'first_name' => 'required|max:50|min:2',
					'middle_name' => 'required|max:50|min:2',
					'last_name' => 'required|max:50|min:2',
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
				$recreate 			= Input::get('recreate');

				// Check first if a department head already exists
				$existingEmployee = Employee::departmentID($department_id)->head()->get();
				if($existingEmployee->count() && $position == 1) {
					if($recreate == 1){
						return $this->createAccount($username, $password, $first_name, $middle_name, $last_name, $email, $mobile, $department_id, $position);
					}
					else {
						$msg = "WARNING: Head employee for " . $department_name . " already exists. To  continue, update password fields and click Save or change employee's position to Member and click Save";
						return 	Redirect::route('account-create')
								->with('recreate', 1)
								->with('global', $msg)
								->withInput();
					}
				}
				else {
					return $this->createAccount($username, $password, $first_name, $middle_name, $last_name, $email, $mobile, $department_id, $position);
				}
			}
		}

		public function createAccount($uN, $pWd, $fN, $mN, $lN, $em, $mob, $dID, $pos) {
			//Add to accounts table
			$account = Account::create(array(
				'username' => $uN,
				'password' => Hash::make($pWd),
				'status' => 1
			));

			//Add to employees table
			$employee = Employee::create(array(
				'username' => $uN,
				'first_name' => $fN,
				'middle_name' => $mN,
				'last_name' => $lN,
				'email' => $em,
				'mobile' => $mob,
				'department_id' => $dID,
				'position' => $pos
			));

			if($account) {
				if($employee) {
					return 	Redirect::route('account-create')
							->with('global', 'Employee account successfully created!');
				}
				else {
					return 	Redirect::route('account-create')
						->with('global', 'Failed to create employee profile!');
				}
			}
			else {
				return 	Redirect::route('account-create')
						->with('global', 'Failed to create employee account!');
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

	}