<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

// Route::get('/', function()
// {
// 	return View::make('master');
// });

Route::get('/', array (
	'as' => 'home',
	'uses' => 'HomeController@home'
));

Route::get('/online-forms', array (
	'as' => 'online-forms',
	'uses' => 'HomeController@forms'
));

Route::get('/admin/add-record', array (
	'as' => 'admin-add-record',
	'uses' => 'HomeController@adminAddRecord'
));

Route::get('/employee/{username}', array (
	'as' => 'profile-employee',
	'uses' => 'ProfileController@employee'
));
/*
*
* Authenticated group
*
*/
Route::group(array('before' => 'auth'), function(){
	/*
	/ CSRF group
	*/
	Route::group(array('before' => 'csrf'), function(){
		/*
		/ System Admin group
		*/
		Route::group(array('before' => 'role'), function() {
			/*
			/ Create employee account (POST)
			*/
			Route::post('/account/create', array(
				'as' => 'account-create-post',
				'uses' => 'AccountController@postCreate'
			));

			/*
			/ Add Department (POST)
			*/
			Route::post('/admin/department/add', array(
				'as' => 'admin-add-department-post',
				'uses' => 'ManageSystemDataController@postAddDepartment'
			));

			/*
			/ Manage Employee Information (POST)
			*/
			Route::post('/employee/{username}', array (
				'as' => 'profile-employee-edit',
				'uses' => 'ProfileController@postEmployee'
			));
		});

		Route::post('account/change-account-details', array(
			'as' => 'account-change-account-details-post',
			'uses' => 'AccountController@postChangeProfileDetails'
		));

	});


	/*
	/ Change Password (GET)
	*/
	Route::get('/account/change-account-details', array(
		'as' => 'account-change-account-details',
		'uses' => 'AccountController@getChangeProfileDetails'
	));

	/*
	/ System Admin group
	*/
	Route::group(array('before' => 'role'), function() {
		/*
		/ Create employee account (GET)
		*/
		Route::get('/account/create', array(
			'as' => 'account-create',
			'uses' => 'AccountController@getCreate'
		));

		/*
		/ Add Department (GET)
		*/
		Route::get('/admin/department/add', array(
			'as' => 'admin-add-department',
			'uses' => 'ManageSystemDataController@getAddDepartment'
		));

		/*
		/ Manage Department (GET)
		*/
		Route::get('/admin/department/manage', array(
			'as' => 'admin-manage-department',
			'uses' => 'ManageSystemDataController@getManageDepartment'
		));

		/*
		/ Manage Employees (GET)
		*/
		Route::get('/admin/employee/manage', array(
			'as' => 'admin-manage-employee',
			'uses' => 'ManageSystemDataController@getManageEmployee'
		));

		/*
		/ Delete Employees (GET)
		*/
		Route::get('/employee/deactivate/{username}', array(
			'as' => 'admin-employee-deactivate',
			'uses' => 'ManageSystemDataController@getDeactiveEmployeeAccount'
		));

		/*
		/ Delete Departments (GET)
		*/
		Route::get('/department/delete/{department}', array(
			'as' => 'admin-department-delete',
			'uses' => 'ManageSystemDataController@getDeleteDepartment'
		));
	});

	/*
	/ Sign out (GET)
	*/
	Route::get('/account/sign-out', array(
		'as' => 'account-sign-out',
		'uses' => 'AccountController@getSignOut'
	));
});


/*
*
* Unauthenticated group
*
*/
Route::group(array('before' => 'guest'), function(){
	/*
	/ CSRF group
	*/
	Route::group(array('before' => 'csrf'), function(){

		/*
		/ Signin (POST)
		*/
		Route::post('/account/sign-in', array(
			'as' => 'account-sign-in-post',
			'uses' => 'AccountController@postSignIn'
		));
			
	});

	/*
	/ Signin (GET)
	*/
	Route::get('/account/sign-in', array(
		'as' => 'account-sign-in',
		'uses' => 'AccountController@getSignIn'
	));
});