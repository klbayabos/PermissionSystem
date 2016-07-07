<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\State;
use App\Process;
use App\RequestApplication;
use App\OBRequestData;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class OBController extends Controller{
	
	public function __construct(){
        $this->middleware('auth');
    }
	
	public function get_currentUser(){
		return \Auth::user();
	}
	
	// display view of obform 
	public function view_obform(){
		$user = DB::table('users')
					->leftJoin('team', 'users.team_id', '=', 'team.team_id')
					->select('team.name as team', 'users.*')
					->where('id', \Auth::user()->id)
					->first();
		return view('obform', ['user' => $user]); 		// view the application for official business form
    }
	
	// when deleting your ob request
	public function del_ob($id = null){
		DB::table('process')
			->join('request', 'request.process_id', '=', 'process.process_id')
			->where('request_id', $id)
			->delete();
		Session::flash('emp_ob_msg', 'The official business request has been deleted');
		return Redirect::to('/officialbusiness');		// view your ob requests
    }
	
	// get details of ob request from DB
	public function get_obdetails_DB($request_id){
		$ob = DB::table('request')
				->leftJoin('users', 'request.id', '=', 'users.id')
				->leftJoin('state','state.state_id', '=', 'request.status')
				->leftJoin('state_type','state_type.state_type_id', '=', 'state.state_type_id')
				->leftJoin('ob_request_data', 'request.request_id', '=', 'ob_request_data.request_id')
				->select('request.*','users.name','ob_request_data.to','ob_request_data.from','state_type.name as state')
				->where('request.request_id', $request_id)
				->first();
				
		$ob_notes = DB::table('request_note')
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
				
		$array_ans = array($ob, $ob_notes, $tl, $sv);
		return $array_ans;
	}
	
	//view the details of an OB request
	public function view_OB_details($request_id = NULL){
		$val = $this->get_obdetails_DB($request_id);
		$ob = $val[0];
		$ob_notes = $val[1];
		$tl = $val[2];
		$sv = $val[3];
		return view('my_ob', ['ob' => $ob, 'obnotes' => $ob_notes, 'tl' => $tl, 'sv' => $sv]);
	}
	
	//view the details of an OB request for approval
	public function view_OB_apdetails($request_id = NULL){
		$val = $this->get_obdetails_DB($request_id);
		$ob = $val[0];
		$ob_notes = $val[1];
		$tl = $val[2];
		$sv = $val[3];
		return view('ob_approval_details', ['ob' => $ob, 'obnotes' => $ob_notes, 'tl' => $tl, 'sv' => $sv]);
	}
	
	// view user's ob requests
	public function view_your_OB(){
		$obs = DB::select("SELECT * FROM (SELECT team_id, name AS team FROM team) AS der1 NATURAL JOIN (SELECT * FROM request WHERE type='OB' and id='".$this->get_currentUser()->id."') as der2 NATURAL JOIN ob_request_data");
		if($obs == null){
			Session::flash('emp_ob_msg', 'You have no official business requests');
		}
		$count = count($obs);
		return view('emp_ob', ['obs' => $obs, 'count' => $count]);
	}
	
	// when submitting your ob request form
	public function get_OBrequest(Request $request){
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
		$req->type = "OB";
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
	public function ob_approval_action(Request $request){
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
}
