<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class OTController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
	// display view of otform
	public function view_otform()
    {
		return view('otform');				// view the application for overtime form & passing the variable
    }
	
	// when deleting your ot request
	public function del_ot()
    {
		return Redirect::to('/overtime');			// view your overtime requests
    }
	
	// when submitting your ot request form
	public function get_OTrequest()
    {
		Session::flash('emp_ot_msg', 'Your OT request has been submitted!');
		
		return Redirect::to('/overtime');			
    }
	
	// when approving or denying an ot request
	public function ot_approval_action(Request $request)
    {
		$input = $request->all();
		
		if ($input['action'] == "Approve"){
			// insert code here
			Session::flash('approval_list_msg', 'The OT request has been approved!');
		}
		elseif ($input['action'] == "Deny"){
			// insert code here
			Session::flash('approval_list_msg', 'The OT request has been denied!');
		}
		return Redirect::to('/aplist');				// view approval list
    }
	
	// sorting ot request by name
	public function sort_ot_name()
    {
		return Redirect::to('/aplist');			
    }
	
	// sorting ot request by team
	public function sort_ot_team()
    {
		return Redirect::to('/aplist');			
    }
}
