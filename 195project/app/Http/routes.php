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
Route::group(['middleware' => 'web'], function(){
	Route::auth();
	
	
	Route::get('/', function () {		
		return view('loginpage');			// view loginpage
	});
	Route::get('/overtime', function () {		
		return view('emp_view');			// view your overtime requests
	});
	Route::get('/officialbusiness', function () {		
		return view('emp_ob');				// view your official business requests
	});
	Route::get('/ob_request', function () {		
		return view('ob_input');			// view the application for official business form
	});
	Route::get('/ot_request', function () {		
		return view('otform');				// view the application for overtime form
	});
	Route::get('/aplist', function () {		
		return view('approval_list');		// view list of requests for approval (**approvers/hr/admin only)
	});
	Route::get('/apdetails', function () {		
		return view('approval_details');	// view the details of request for approval (**approvers/hr/admin only)
	});
	Route::get('/acc', function () {		
		return view('manage_acc');			// view of managing account (**hr/admin only)
	});
});