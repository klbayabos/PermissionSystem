<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class OBController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
	// display view of obform 
	public function view_obform()
    {
		return view('obform'); 							// view the application for official business form
    }
	
	// when deleting your ob request
	public function del_ob()
    {
		return Redirect::to('/officialbusiness');		// view your ob requests
    }
	
	// when submitting your ob request form
	public function get_OBrequest()
    {
		Session::flash('emp_ob_msg', 'Your OB request has been submitted!');
		return Redirect::to('/officialbusiness');			
    }
	
	// when approving or denying an ob request
	public function ob_approval_action(Request $request)
    {
		$input = $request->all();
		
		if ($input['action'] == "Approve"){
			// insert code here
			Session::flash('approval_list_msg', 'The OB request has been approved!');
		}
		elseif ($input['action'] == "Deny"){
			// insert code here
			Session::flash('approval_list_msg', 'The OB request has been denied!');
		}
		return Redirect::to('/aplist');				// view approval list
    }
	
	// sorting ob request by name
	public function sort_ob_name()
    {
		return Redirect::to('/aplist');			
    }
	
	// sorting ob request by team
	public function sort_ob_team()
    {
		return Redirect::to('/aplist');			
    }
}
