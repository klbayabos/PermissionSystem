<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Process;
use App\RequestApplication;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class OTController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
	// display view of otform
	public function view_otform()
    {
		$user = DB::table('users')
					->leftJoin('team', 'users.team_id', '=', 'team.team_id')
					->select('team.name as team', 'users.*')
					->where('id', \Auth::user()->id)
					->first();
		return view('otform', ['user' => $user]);		// view the application for overtime form 
    }
	
	// when deleting your ot request
	public function del_ot()
    {
		return Redirect::to('/overtime');			// view your overtime requests
    }
	public function view_your_OT()
	{
		$ots = DB::table('request')
					->where('id', \Auth::user()->id)
					->get();
		$count = count($ots);
		return view('emp_ot', ['ots' => $ots, 'count' => $count]);
	}
	// when submitting your ot request form
	public function get_OTrequest(Request $request)
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
		$req->type = "OT";
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
