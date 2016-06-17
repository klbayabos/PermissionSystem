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
	
	
	Route::get('/', function () {		// ito yung default na pupuntahan pag naglocalhost:8000
		return view('loginpage');		// view loginpage
	});
	Route::get('/overtime', function () {		
		return view('emp_view');
	});
	Route::get('/officialbusiness', function () {		
		return view('emp_ob');
	});
	Route::get('/otdetails', function () {		
		return view('emp_view_ot_details');
	});
	Route::get('/ob_request', function () {		
		return view('ob_input');
	});
	/*
	Route::get('/insertkahitanongname', function () {		
		return view('filename_ng_view');
	});
	*/
});