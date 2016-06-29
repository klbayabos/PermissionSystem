<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
class ONController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	// display view of onform 
	public function view_onform()
    {
		return view('onform'); 							// view the application for overnight form 
    }
	
	// when deleting your on request
	public function del_on()
    {
		return Redirect::to('/overnight');				// view your on requests
    }
	
	// when submitting your on request form
	public function get_ONrequest()
    {
		Session::flash('emp_on_msg', 'Your overnight request has been submitted!');
		return Redirect::to('/overnight');			
    }
	
	// when approving or denying an on request
	public function on_approval_action(Request $request)
    {
		$input = $request->all();
		
		if ($input['action'] == "Approve"){
			// insert code here
			Session::flash('approval_list_msg', 'The overnight request has been approved!');
		}
		elseif ($input['action'] == "Deny"){
			// insert code here
			Session::flash('approval_list_msg', 'The overnight request has been denied!');
		}
		return Redirect::to('/aplist');				// view approval list
    }
	
	// sorting on request by name
	public function sort_on_name()
    {
		return Redirect::to('/aplist');			
    }
	
	// sorting on request by team
	public function sort_on_team()
    {
		return Redirect::to('/aplist');			
    }
}
