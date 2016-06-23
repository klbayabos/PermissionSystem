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
	if (Auth::check()){										
		return Redirect::to('/overtime');
	}
	return view('auth\login');								// view of loginpage
});

// VIEW OT FORM & OB FORM & MANAGE ACCOUNT
Route::any('/ob_request', 'OBController@view_obform');		// go to ..\app\Http\Controllers\OTController then look for the function 'view_obform'
Route::any('/ot_request', 'OTController@view_otform');		// go to OTController@view_otform
Route::any('/acc', 'AccountController@view_acc');			// go to ..\app\Http\Controllers\AccountController then look for the function 'view_acc'

// WHEN SUBMITTING OT & OB REQUEST FORM
Route::post('/getOBrequest', 'OBController@get_OBrequest');	
Route::post('/getOTrequest', 'OTController@get_OTrequest');	


// WHEN DELETING YOUR OT $ OB REQUEST
Route::get('/delete_ot', 'OTController@del_ot');			// go to ..\app\Http\Controllers\OTController then look for the function 'del_ot'
Route::get('/delete_ob', 'OBController@del_ob');	

// WHEN SEARCHING NAME IN THE SEARCHBOX
Route::post('/search', 'AccountController@search_name');	// go to ..\app\Http\Controllers\AccountController then look for the function 'search_name'

// WHEN CHANGING TYPE OF USER
Route::get('/change/{id?}', 'AccountController@changetype');	
Route::post('/changetypeofuser', 'AccountController@changetype_inDB');	


	
Route::get('/loginpage', function () {		
	return view('loginpage');					// view your overtime requests
});
Route::get('/overtime', function () {		
	return view('emp_ot');						// view your overtime requests
});
Route::get('/officialbusiness', function () {		
	return view('emp_ob');						// view your official business requests
});
Route::get('/aplist', function () {		
	return view('approval_list');				// view list of requests for approval (**approvers/hr/admin only)
});


Route::get('/otdetails', function () {		
	return view('my_ot');						// view the details of your OT request 
});
Route::get('/obdetails', function () {		
	return view('my_ob');						// view the details of your OB request 
});

Route::get('/ot_apdetails', function () {		
	return view('ot_approval_details');			// view the details of OT request for approval (**approvers/hr/admin only)
});
Route::get('/ob_apdetails', function () {		
	return view('ob_approval_details');			// view the details of OB request for approval (**approvers/hr/admin only)
});