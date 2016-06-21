<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/** For oath2 **/

Route::get('/redirect', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');

// == == //


Route::auth();

Route::get('/', function () {
	if (Auth::check()){					// check if the user is logged in
		return Redirect::to('/overtime');
	}
	return view('auth\login');			// view of loginpage
});

// VIEW OT FORM & OB FORM & MANAGE ACCOUNT
Route::any('/ob_request', 'OBController@view_obform');		// go to ..\app\Http\Controllers\OTController then look for the function 'view_obform'
Route::any('/ot_request', 'OTController@view_otform');		// go to OTController@view_otform
Route::any('/acc', 'AccountController@view_acc');			// go to ..\app\Http\Controllers\AccountController then look for the function 'view_acc'
/*
Route::get('/ob_request', function () {		
	return view('ob_input');			// view the application for official business form
});
Route::get('/ot_request', function () {		
	return view('otform');				// view the application for overtime form
});

Route::get('/acc', function () {		
	return view('manage_acc');			// view of managing account (**approvers/hr/admin only)
});
*/	
	
	
	
Route::get('/loginpage', function () {		
	return view('loginpage');			// view your overtime requests
});
Route::get('/overtime', function () {		
	return view('emp_view');			// view your overtime requests
});
Route::get('/officialbusiness', function () {		
	return view('emp_ob');				// view your official business requests
});
Route::get('/aplist', function () {		
	return view('approval_list');		// view list of requests for approval (**approvers/hr/admin only)
});
Route::get('/apdetails', function () {		
	return view('approval_details');	// view the details of request for approval (**approvers/hr/admin only)
});