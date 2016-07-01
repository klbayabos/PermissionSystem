<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Process;
use App\RequestApplication;
use App\OBRequestData;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class OBController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
	// display view of obform 
	public function view_obform()
    {
		$user = DB::table('users')
					->leftJoin('team', 'users.team_id', '=', 'team.team_id')
					->select('team.name as team', 'users.*')
					->where('id', \Auth::user()->id)
					->first();
		return view('obform', ['user' => $user]); 		// view the application for official business form
    }
	
	// when deleting your ob request
	public function del_ob()
    {
		return Redirect::to('/officialbusiness');		// view your ob requests
    }
	
	// when submitting your ob request form
	public function get_OBrequest(Request $request)
    {
		$time=Carbon::now();
		$time=$time->toAtomString();
		$status = DB::table('state_type')
					->where('name','submitted')
					->first();
		$input = $request->all();
		$process = new Process;
		$process->name = \Auth::user()->id.'_'.$time;
		$saved = $process->save();
		if(!$saved){
			App::abort(500, 'Error');
		}
		$req = new RequestApplication;
		$req->id = \Auth::user()->id;
		$req->type = "OB";
		$req->process_id = $process->process_id;
		$req->team_id = \Auth::user()->team_id;
		$req->starting_date = $input['fromdate'];
		$req->end_date = $input['todate'];
		$req->starting_time = $input['fromtime'];
		$req->end_time = $input['totime'];
		$req->request_purpose = $input['purpose'];
		$req->status = $status->state_type_id;
		$saved = $req->save();
		if(!$saved){
			App::abort(500, 'Error');
		}
		$obdata = new OBRequestData;
		$obdata->request_id = $req->request_id;
		$obdata->to = $input['to'];
		$obdata->from = $input['from'];
		$saved = $obdata->save();
		if(!$saved){
			App::abort(500, 'Error');
		}
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
