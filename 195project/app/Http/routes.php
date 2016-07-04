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



Route::auth();

Route::get('/', function () {
	if (Auth::check()){										
		return Redirect::to('/overtime');
	}
	return view('auth\login');						// view of loginpage
});


// VIEW OB/OT/ON FORM & MANAGE ACCOUNT
Route::get('/ob_request', 'OBController@view_obform');		
Route::get('/ot_request', 'OTController@view_otform');		
Route::get('/on_request', 'ONController@view_onform');
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
Route::post('/search', 'AccountController@search_word');	

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
// view of adding a new employee (user)
Route::get('/add_emp','AccountController@view_add_employee');
Route::post('/new_emp', 'AccountController@add_employee');

// ADD TEAM
Route::get('/add_team',  function () {
	return view('add_team');					// view of adding a new team
});
Route::post('/new_team', 'TeamController@add_newteam_DB');	// add new team in DB

// DELETE TEAM
Route::get('/del_team', 'TeamController@del_team_view');
Route::post('/delete_team', 'TeamController@del_team_DB');	// delete team in DB

// ADD TYPE
Route::get('/add_type',  function () {		
	return view('add_type');					// view of adding a new type
});
Route::post('/new_type', 'TypeController@add_newtype_DB');	// add new type in DB

// DELETE TYPE
Route::get('/del_type', 'TypeController@del_type_view');
Route::post('/delete_type', 'TypeController@del_type_DB');	// delete type in DB

// EDIT EMPLOYEE'S INFO
Route::get('/change/{id?}', 'AccountController@change_info_view');	
Route::post('/edit_emp', 'AccountController@edit_employee');


Route::get('/loginpage', function () {		
	return view('loginpage');					// login page
});
// Route::post('/getOTrequest', 'OTController@get_OTrequest');	
Route::get('/overtime', 'OTController@view_your_OT');						// view your overtime requests
Route::get('/officialbusiness', 'OBController@view_your_OB');				// view your official business requests
Route::get('/overnight', 'ONController@view_your_ON');				// view your official business requests
Route::get('/aplist', 'RequestController@view_all');

//my_ot/ob/on.blade.php - details page
Route::get('/otdetails/{request_id?}', 'OTController@view_OT_details');
Route::get('/obdetails/{request_id?}', 'OBController@view_OB_details');
Route::get('/ondetails/{request_id?}', 'ONController@view_ON_details');


Route::get('/ot_apdetails', function () {		
	return view('ot_approval_details');			// view the details of OT request for approval 
});
Route::get('/ob_apdetails', function () {		
	return view('ob_approval_details');			// view the details of OB request for approval 
});
Route::get('/on_apdetails', function () {		
	return view('on_approval_details');			// view the details of ON request for approval 
});

//view all requests