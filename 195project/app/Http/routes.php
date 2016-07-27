<?php

/** For oath2 **/

Route::get('/redirect', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');

Route::auth();

Route::get('/', function () {
	if (Auth::check()){										
		return redirect('/logout');
	}
	return redirect('/login');						// view of loginpage
});


Route::group(['middleware' => ['auth', 'empview']], function () {

	// VIEW OB/OT/ON REQUESTS 
	Route::get('/overtime', 'OTController@view_your_OT');					
	Route::get('/officialbusiness', 'OBController@view_your_OB');				
	Route::get('/overnight', 'ONController@view_your_ON');	

	// VIEW OB/OT/ON REQUESTS - details page
	Route::get('/otdetails/{request_id?}', 'OTController@view_OT_details');
	Route::get('/obdetails/{request_id?}', 'OBController@view_OB_details');
	Route::get('/ondetails/{request_id?}', 'ONController@view_ON_details');
	
	// VIEW OB/OT/ON FORM 
	Route::get('/ob_request', 'OBController@view_obform');	
	Route::get('/ot_request', 'OTController@view_otform');		
	Route::get('/on_request', 'ONController@view_onform');

	// WHEN SUBMITTING OB/OT/ON  REQUEST FORM
	Route::post('/getOBrequest', 'OBController@get_OBrequest');	
	Route::post('/getOTrequest', 'OTController@get_OTrequest');	
	Route::post('/getONrequest', 'ONController@get_ONrequest');	

	// WHEN DELETING OB/OT/ON REQUEST
	Route::get('/delete_ot/{id?}', 'OTController@del_ot');			
	Route::get('/delete_ob/{id?}', 'OBController@del_ob');			
	Route::get('/delete_on/{id?}', 'ONController@del_on');
	

});

Route::group(['middleware' => ['auth', 'adminview']], function () {
	
	// DISABLE/ENABLE A USER (EMPLOYEE)
	Route::get('/delete_user/{id?}', 'AccountController@del_user');	
	Route::get('/enable_user/{id?}', 'AccountController@activate_user');

	// ADD EMPLOYEE
	Route::get('/add_emp','AccountController@view_add_employee');
	Route::post('/new_emp', 'AccountController@add_employee');

	// ADD TEAM
	Route::get('/add_team',  function () {
		return view('add_team');					
	});
	Route::post('/new_team', 'TeamController@add_newteam_DB');	

	// DELETE TEAM
	Route::get('/del_team', 'TeamController@del_team_view');
	Route::post('/delete_team', 'TeamController@del_team_DB');	

	// ADD TYPE
	Route::get('/add_type',  function () {		
		return view('add_type');					
	});
	Route::post('/new_type', 'TypeController@add_newtype_DB');	

	// DELETE TYPE
	Route::get('/del_type', 'TypeController@del_type_view');
	Route::post('/delete_type', 'TypeController@del_type_DB');	

	// EDIT EMPLOYEE'S INFO
	Route::get('/change/{id?}', 'AccountController@change_info_view');	
	Route::post('/edit_emp', 'AccountController@edit_employee');

	// VIEW STATS
	Route::post('/stats', [
		'as' => 'stats', 'uses' =>'AccountController@view_stats'
	]);

	// DOWNLOAD APPROVED REQUESTS
	Route::get('/dl_ob', 'RequestController@download_ob');
	Route::get('/dl_ot', 'RequestController@download_ot');
	Route::get('/dl_on', 'RequestController@download_on');

});


Route::group(['middleware' => ['auth', 'approvalview']], function () {
	
	// OB/OT/ON APPROVAL
	Route::post('/ot_approval', 'OTController@ot_approval_action');	
	Route::post('/ob_approval', 'OBController@ob_approval_action');	
	Route::post('/on_approval', 'ONController@on_approval_action');	

	// SORTING REQUESTS (BY NAME OR TEAM OR DATE)
	Route::get('/otrequest_sortname', 'RequestController@sort_ot_name');			
	Route::get('/otrequest_sortteam', 'RequestController@sort_ot_team');			
	Route::get('/otrequest_sortdate', 'RequestController@sort_ot_date');	
	Route::get('/obrequest_sortname', 'RequestController@sort_ob_name');			
	Route::get('/obrequest_sortteam', 'RequestController@sort_ob_team');			
	Route::get('/obrequest_sortdate', 'RequestController@sort_ob_date');
	Route::get('/onrequest_sortname', 'RequestController@sort_on_name');			
	Route::get('/onrequest_sortteam', 'RequestController@sort_on_team');			
	Route::get('/onrequest_sortdate', 'RequestController@sort_on_date');	

	// ENDORSE/APPROVE/DENY REQUESTS
	Route::post('/request_act','RequestController@request_action');
	
	// VIEW LIST OF REQUESTS FOR APPROVAL
	Route::get('/aplist', 'RequestController@view_all');

	// VIEW OB/OT/ON REQUESTS FOR APPROVAL - details page
	Route::get('/on_apdetails/{request_id?}', 'ONController@view_ON_apdetails');
	Route::get('/ot_apdetails/{request_id?}', 'OTController@view_OT_apdetails');
	Route::get('/ob_apdetails/{request_id?}', 'OBController@view_OB_apdetails');
	
});

	
Route::group(['middleware' => ['auth', 'headview']], function () {
		
	//Make OIC
	Route::get('/makeoic/{id?}', 'AccountController@make_oic');
	Route::post('/submitoic', 'AccountController@submit_oic');
	
});


Route::group(['middleware' => ['auth', 'manage_acc_view']], function () {
	
	// MANAGE ACCOUNT VIEW
	Route::any('/acc', 'AccountController@view_acc');
	
	// WHEN SEARCHING NAME IN THE SEARCHBOX
	Route::get('/search', 'AccountController@search_word');	

});
