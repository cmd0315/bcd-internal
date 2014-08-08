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
		return View::make('home');
	}

	public function dashboard() {
		return View::make('account.dashboard');
	}

	public function forms() {
		return View::make('online-forms.leave-of-absence');
	}

	public function adminAddRecord() {
		return View::make('admin.add-record');
	}
}
