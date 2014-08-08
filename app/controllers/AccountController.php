<?php

	class AccountController extends BaseController {

		/* viewing the signin form */
		public function getSignIn() {
			return View::make('account.signin');
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
			return 	View::make('account.create')
					->with('departments', Department::orderBy('department')->get());
		}

		/* submitting the form */
		public function postCreate() {
			$validator = Validator::make(Input::all(), 
				array(
					'username' => 'required|max:20|min:5|unique:accounts',
					'password' => 'required|max:50|min:6',
					'password_again' => 'required|same:password',
					'name' => 'required|max:50',
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
				$username 	= Input::get('username');
				$password 	= Input::get('password');
				$name 		= Input::get('name');
				$email 		= Input::get('email');
				$mobile 	= Input::get('mobile');
				$department = Input::get('department');
				$position 	= Input::get('position');

				//Add to accounts table
				$account = Account::create(array(
					'username' => $username,
					'password' => Hash::make($password),
					'status' => 1
				));

				//Add to employees table
				$employee = Employee::create(array(
					'username' => $username,
					'name' => $name,
					'email' => $email,
					'mobile' => $mobile,
					'department' => $department,
					'position' => $position
				));


				if($account) {
					if($employee) {
						return 	Redirect::route('admin-add-record')
								->with('global', 'Employee account created!');
					}
					else {
						return 	Redirect::route('account-create');
					}
				}
				else {
						return 	Redirect::route('account-create');
				}
			}
		}

		/* viewing the change profile details form */
		public function getChangeProfileDetails() {
			return View::make('account.employee-profile');
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
				return 	Redirect::route('account-change-profile-details')
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
					return  Redirect::route('account-change-profile-details')
							->with('global', 'Old password given does not match record');
				}
			}
			return  Redirect::route('account-change-profile-details')
					->with('global', 'Cannot change password');
		}

	}