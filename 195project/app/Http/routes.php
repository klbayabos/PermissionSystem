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
	return view('auth\login');						// view of loginpage
});

// NOTE: post for forms, get for buttons

// VIEW OT FORM & OB FORM & MANAGE ACCOUNT
Route::any('/ob_request', 'OBController@view_obform');		
Route::any('/ot_request', 'OTController@view_otform');		
Route::any('/acc', 'AccountController@view_acc');			


// WHEN SUBMITTING OT & OB REQUEST FORM
Route::post('/getOBrequest', 'OBController@get_OBrequest');	
Route::post('/getOTrequest', 'OTController@get_OTrequest');	


// WHEN DELETING YOUR OT $ OB REQUEST
Route::get('/delete_ot', 'OTController@del_ot');			
Route::get('/delete_ob', 'OBController@del_ob');	

// WHEN DELETING A USER (EMPLOYEE)
Route::get('/delete_user/{id?}', 'AccountController@del_user');	

// WHEN SEARCHING NAME IN THE SEARCHBOX
Route::post('/search', 'AccountController@search_name');	

// WHEN CHANGING TYPE OF USER
Route::get('/change/{id?}', 'AccountController@changetype');	
Route::post('/changetypeofuser', 'AccountController@changetype_inDB');	

// OT & OB APPROVAL
Route::post('/ot_approval', 'OTController@ot_approval_action');	
Route::post('/ob_approval', 'OBController@ob_approval_action');	

	
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

Route::post('/set_oic_time', function () {		
	return view('oic_time');					// Set date range of temporary OIC
});