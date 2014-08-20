<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	
	public function home() {
		return View::make('home', array('pageTitle' => 'Home'));
	}

	public function dashboard() {
		return View::make('account.dashboard', array('pageTitle' => 'Dashboard'));
	}

	public function adminAddRecord() {
		return View::make('admin.add-record', array('pageTitle' => 'Add System Record'));
	}

	public function getManageDepartment() {
		return 	View::make('admin.manage-department', array('pageTitle' => 'Manage Departments'))
				->with('departments', Department::orderBy('department')->get());
	}

	public function getManageEmployee() {
		return 	View::make('admin.manage-employee', array('pageTitle' => 'Manage Employees'))
				->with('employees', Employee::orderBy('last_name')->get());
	}

	public function getManageClient() {
		return 	View::make('admin.manage-client', array('pageTitle' => 'Manage Clients'))
				->with('clients', Client::orderBy('client_name')->get());
	}

	// public function getManageForm($username) {
	// 	return 	View::make('online-forms.manage', array('pageTitle' => 'Manage Created Forms'))
	// 			->with('onlineForms', OnlineForm::where('created_by', $username));
	// }
}
