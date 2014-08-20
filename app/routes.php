<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/
Route::get('/', array (
	'as' => 'home',
	'uses' => 'HomeController@home'
));
Route::get('/dashboard', array (
	'as' => 'dashboard',
	'uses' => 'HomeController@dashboard'
));

/*
*
* Authenticated group
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
				'as' => 'admin-department-add-post',
				'uses' => 'DepartmentController@postAddDepartment'
			));

			/*
			/ Edit Employee Information (POST)
			*/
			Route::post('/employee/{username}', array (
				'as' => 'profile-employee-edit',
				'uses' => 'ProfileController@postEmployee'
			));

			/*
			/ Edit Department Information (POST)
			*/
			Route::post('admin/department/{departmentID}', array (
				'as' => 'admin-department-edit-post',
				'uses' => 'DepartmentController@postEditDepartment'
			));

			/*
			/ Add Client (POST)
			*/
			Route::post('/admin/client/add', array(
				'as' => 'admin-client-add-post',
				'uses' => 'ClientController@postAddClient'
			));

			/*
			/ Edit Client Information (POST)
			*/
			Route::post('/admin/client/{clientID}/edit', array (
				'as' => 'admin-client-edit-post',
				'uses' => 'ClientController@postEditClient'
			));
		});

		/*
		/ Update Account Information (POST)
		*/
		Route::post('account/change-account-details', array(
			'as' => 'account-change-account-details-post',
			'uses' => 'AccountController@postChangeProfileDetails'
		));

		/*
		/ Request for Payment (POST)
		*/
		Route::post('/online-forms/request-for-payment', array (
			'as' => 'request-for-payment-post',
			'uses' => 'RequestForPaymentController@postForm'
		));

	});


	/*
	/ System Admin group
	*/
	Route::group(array('before' => 'role'), function() {
		/*
		/ View Options for System Records Management (POST)
		*/
		Route::get('/admin/add-record', array (
			'as' => 'admin-add-record',
			'uses' => 'HomeController@adminAddRecord'
		));

		/*
		/ Create employee account (GET)
		*/
		Route::get('/account/create', array(
			'as' => 'account-create',
			'uses' => 'AccountController@getCreate'
		));

		/*
		/ Manage Department (GET)
		*/
		Route::get('/admin/departments/manage', array(
			'as' => 'admin-manage-department',
			'uses' => 'HomeController@getManageDepartment'
		));

		/*
		/ Manage Employees (GET)
		*/
		Route::get('/admin/employees/manage', array(
			'as' => 'admin-manage-employee',
			'uses' => 'HomeController@getManageEmployee'
		));

		/*
		/ Manage Client (GET)
		*/
		Route::get('/admin/clients/manage', array(
			'as' => 'admin-client-manage',
			'uses' => 'HomeController@getManageClient'
		));

		/*
		/ Add Department (GET)
		*/
		Route::get('/admin/department/add', array(
			'as' => 'admin-department-add',
			'uses' => 'DepartmentController@getAddDepartment'
		));

		/*
		/ Delete Departments (GET)
		*/
		Route::get('/admin/department/delete/{department}', array(
			'as' => 'admin-department-delete',
			'uses' => 'DepartmentController@getDeleteDepartment'
		));

		/*
		/ Delete Employees (GET)
		*/
		Route::get('/admin/employee/deactivate/{username}', array(
			'as' => 'admin-employee-deactivate',
			'uses' => 'AccountController@getDeactiveEmployeeAccount'
		));

		/*
		/ Edit Department Information (GET)
		*/
		Route::get('/admin/department/{departmentID}/edit', array (
			'as' => 'admin-department-edit',
			'uses' => 'DepartmentController@getEditDepartment'
		));

		/*
		/ Add Client (GET)
		*/
		Route::get('/admin/client/add', array (
			'as' => 'admin-client-add',
			'uses' => 'ClientController@getAddClient'
		));

		/*
		/ Edit Client Information (GET)
		*/
		Route::get('/admin/client/{clientID}/edit', array (
			'as' => 'admin-client-edit',
			'uses' => 'ClientController@getEditClient'
		));
	});

	/*
	/ View Form Options (GET)
	*/
	Route::get('/online-forms', array (
		'as' => 'online-forms',
		'uses' => 'LeaveOfAbsenceController@getForm'
	));

	/*
	/ Request for Payment (GET)
	*/
	Route::get('/online-forms/request-for-payment', array (
		'as' => 'request-for-payment',
		'uses' => 'RequestForPaymentController@getForm'
	));

	/*
	/ View Employee Information (GET)
	*/
	Route::get('/employee/{username}', array (
		'as' => 'profile-employee',
		'uses' => 'ProfileController@employee'
	));

	/*
	/ Update Account Information (GET)
	*/
	Route::get('/account/change-account-details', array(
		'as' => 'account-change-account-details',
		'uses' => 'AccountController@getChangeProfileDetails'
	));

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