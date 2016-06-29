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

// NOTE: post for forms, get for buttons/link

// VIEW OB/OT/ON FORM & MANAGE ACCOUNT
Route::any('/ob_request', 'OBController@view_obform');		
Route::any('/ot_request', 'OTController@view_otform');		
Route::any('/on_request', 'ONController@view_onform');
Route::any('/acc', 'AccountController@view_acc');			

// WHEN SUBMITTING OB/OT/ON  REQUEST FORM
Route::post('/getOBrequest', 'OBController@get_OBrequest');	
Route::post('/getOTrequest', 'OTController@get_OTrequest');	
Route::post('/getONrequest', 'ONController@get_ONrequest');	

// WHEN DELETING OB/OT/ON REQUEST
Route::get('/delete_ot', 'OTController@del_ot');			
Route::get('/delete_ob', 'OBController@del_ob');			
Route::get('/delete_on', 'ONController@del_on');

// WHEN DELETING A USER (EMPLOYEE)
Route::get('/delete_user/{id?}', 'AccountController@del_user');	

// WHEN SEARCHING NAME IN THE SEARCHBOX
Route::post('/search', 'AccountController@search_name');	

// OB/OT/ON APPROVAL
Route::post('/ot_approval', 'OTController@ot_approval_action');	
Route::post('/ob_approval', 'OBController@ob_approval_action');	
Route::post('/on_approval', 'ONController@on_approval_action');	

// SORTING REQUESTS (BY NAME OR TEAM)
Route::get('/otrequest_sortname', 'OTController@sort_ot_name');			
Route::get('/otrequest_sortteam', 'OTController@sort_ot_team');	
Route::get('/obrequest_sortname', 'OBController@sort_ob_name');			
Route::get('/obrequest_sortteam', 'OBController@sort_ob_team');	
Route::get('/onrequest_sortname', 'ONController@sort_on_name');			
Route::get('/onrequest_sortteam', 'ONController@sort_on_team');	

// ADD EMPLOYEE
Route::get('/add_emp',  function () {		
	return view('add_emp');						// view of adding a new employee (user)
});
Route::post('/new_emp', 'AccountController@add_employee');

// ADD TEAM
Route::get('/add_team',  function () {		
	return view('add_team');					// view of adding a new team
});

// ADD TYPE
Route::get('/add_type',  function () {		
	return view('add_type');					// view of adding a new type
});

// EDIT EMPLOYEE'S INFO
Route::get('/change/{id?}', 'AccountController@change_info_view');	
Route::post('/edit_emp', 'AccountController@edit_employee');


Route::get('/loginpage', function () {		
	return view('loginpage');					// view your overtime requests
});
Route::get('/overtime', function () {		
	return view('emp_ot');						// view your overtime requests
});
Route::get('/officialbusiness', function () {		
	return view('emp_ob');						// view your official business requests
});
Route::get('/overnight', function () {		
	return view('emp_on');						// view your overnight requests
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
Route::get('/ondetails', function () {		
	return view('my_on');						// view the details of your ON request 
});


Route::get('/ot_apdetails', function () {		
	return view('ot_approval_details');			// view the details of OT request for approval (**approvers/hr/admin only)
});
Route::get('/ob_apdetails', function () {		
	return view('ob_approval_details');			// view the details of OB request for approval (**approvers/hr/admin only)
});
Route::get('/on_apdetails', function () {		
	return view('on_approval_details');			// view the details of ON request for approval (**approvers/hr/admin only)
});