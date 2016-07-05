<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\State;
use App\Process;
use App\RequestApplication;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class ONController extends Controller{
	
    public function __construct(){
        $this->middleware('auth');
    }
	
	// display view of onform 
	public function view_onform(){
		$user = DB::table('users')
					->leftJoin('team', 'users.team_id', '=', 'team.team_id')
					->select('team.name as team', 'users.*')
					->where('id', \Auth::user()->id)
					->first();
		return view('onform', ['user' => $user]); 		// view the application for overnight form 
    }
	
	// when deleting your on request
	public function del_on(){
		return Redirect::to('/overnight');				// view your on requests
    }
	
	// get details of on request from DB
	public function get_ondetails_DB($request_id){
		$on = DB::table('request')
					->leftJoin('users', 'request.id', '=', 'users.id')
					->leftJoin('state','state.state_id', '=', 'request.status')
					->leftJoin('state_type','state_type.state_type_id', '=', 'state.state_type_id')
					->select('request.*','users.name','state_type.name as state')
					->where('request_id', $request_id)
					->first();
		$on_notes = DB::table('request_note')
					->where('request_id', $request_id)
					->get();
				
		// get team leader
		$tl = DB::table('team')
				->join('users', 'team.team_id', '=', 'users.team_id')
				->where('users.team_id', \Auth::user()->team_id)
				->where('users.type_id', 7)
				->first();
		
		// get supervisor
		$sv = DB::table('team')
				->join('users', 'team.team_id', '=', 'users.team_id')
				->where('users.team_id', \Auth::user()->team_id)
				->where('users.type_id', 5)
				->first();
				
		$array_ans = array($on, $on_notes, $tl, $sv);
		return $array_ans;
	}
	
	//view the details of an ON request
	public function view_ON_details($request_id = NULL){
		$val = $this->get_ondetails_DB($request_id);
		$on = $val[0];
		$on_notes = $val[1];
		$tl = $val[2];
		$sv = $val[3];
		return view('my_on', ['on' => $on, 'onnotes' => $on_notes, 'tl' => $tl, 'sv' => $sv]);
	}	
	
	//view the details of an ON request for approval
	public function view_ON_apdetails($request_id = NULL){
		$val = $this->get_ondetails_DB($request_id);
		$on = $val[0];
		$on_notes = $val[1];
		$tl = $val[2];
		$sv = $val[3];
		return view('on_approval_details', ['on' => $on, 'onnotes' => $on_notes, 'tl' => $tl, 'sv' => $sv]);
	}
	
	// view user's overnight requests
	public function view_your_ON(){
		$ons = DB::table('request')
					->where('id', \Auth::user()->id)
					->where('type', 'ON')
					->get();
		if($ons == null){
			Session::flash('emp_on_msg', 'You have no overnight requests');
		}
		//DB::select("SELECT * FROM (SELECT team_id, name AS team FROM team) AS der1 NATURAL JOIN (SELECT * FROM request WHERE type='ON') as der2");
		$count = count($ons);
		return view('emp_on', ['ons' => $ons, 'count' => $count]);
	}
	// when submitting your on request form
	public function get_ONrequest(Request $request){
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
		$state = new State;
		$state->state_type_id = $status->state_type_id;
		$state->process_id = $process->process_id;
		$state->name = \Auth::user()->id.'_'.$time;
		$saved = $state->save();
		if(!$saved){
			App::abort(500, 'Error');
		}
		$req = new RequestApplication;
		$req->id = \Auth::user()->id;
		$req->type = "ON";
		$req->process_id = $process->process_id;
		$req->team_id = \Auth::user()->team_id;
		$req->starting_date = $input['fromdate'];
		$req->end_date = $input['todate'];
		$req->starting_time = $input['fromtime'];
		$req->end_time = $input['totime'];
		$req->request_purpose = $input['purpose'];
		$req->status = $state->state_id;
		$saved = $req->save();
		if(!$saved){
			App::abort(500, 'Error');
		}
		Session::flash('emp_on_msg', 'Your overnight request has been submitted!');
		return Redirect::to('/overnight');			
    }
	
	// when approving or denying an on request
	public function on_approval_action(Request $request){
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
	public function sort_on_name(){
		return Redirect::to('/aplist');			
    }
	
	// sorting on request by team
	public function sort_on_team(){
		return Redirect::to('/aplist');			
    }
}
