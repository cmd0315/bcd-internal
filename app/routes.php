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
		Route::post('account/change-profile-details', array(
			'as' => 'account-change-profile-details-post',
			'uses' => 'AccountController@postChangeProfileDetails'
		));
	});


	/*
	/ Change Password (GET)
	*/
	Route::get('/account/change-profile-details', array(
		'as' => 'account-change-profile-details',
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
		/ Create employee account (POST)
		*/
		Route::post('/account/create', array(
			'as' => 'account-create-post',
			'uses' => 'AccountController@postCreate'
		));


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

	/*
	/ Create employee account (GET)
	*/
	Route::get('/account/create', array(
		'as' => 'account-create',
		'uses' => 'AccountController@getCreate'
	));
});