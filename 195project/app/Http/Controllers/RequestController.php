<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Process;
use App\State;
use App\Transition;
use App\RequestNote;
use App\ApprovedDate;
use App\RequestApplication;
use App\OBRequestData;
use App\Http\Requests;
use Input;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class RequestController extends Controller{
	
	public function __construct(){
        $this->middleware('auth');
    }
	
	// get requests of team
	public function get_req($type){
		$req = DB::table('request')
					->leftJoin('users', 'request.id', '=', 'users.id')
					->leftJoin('team', 'users.team_id', '=', 'team.team_id')
					->where('team.team_id', '=', \Auth::user()->team_id)
					->leftJoin('state','state.state_id', '=', 'request.status')
					->leftJoin('state_type','state_type.state_type_id', '=', 'state.state_type_id')
					->select('team.name as team', 'request.*','users.id','users.name','state_type.name as state')
					->where('type', $type)
					->get();
		return $req;
	}
	
	// get requests of team sorted by either name or team 
	public function get_req_sort($type, $group){
		$req = DB::table('request')
					->leftJoin('users', 'request.id', '=', 'users.id')
					->leftJoin('team', 'users.team_id', '=', 'team.team_id')
					->where('team.team_id', '=', \Auth::user()->team_id)
					->leftJoin('state','state.state_id', '=', 'request.status')
					->leftJoin('state_type','state_type.state_type_id', '=', 'state.state_type_id')
					->select('team.name as team', 'request.*','users.id','users.name','state_type.name as state')
					->where('type', $type)
					->orderBy($group, 'asc')
					->get();
		return $req;
	}
	
	public function view_all(){
		$obs = $this->get_req('OB');
		$ots = $this->get_req('OT');
		$ons = $this->get_req('ON');
		return view('approval_list', ['obs' => $obs, 'ots' => $ots, 'ons' => $ons]);
	}
	
	// sorting ob request by name
	public function sort_ob_name(){
		$obs = $this->get_req_sort('OB', 'name');
		$ots = $this->get_req('OT');
		$ons = $this->get_req('ON');
		$tabName = "ob";
		return view('approval_list', ['obs' => $obs, 'ots' => $ots, 'ons' => $ons, 'tabName' => $tabName]);		
    }
	
	// sorting ob request by team
	public function sort_ob_team(){
		$obs = $this->get_req_sort('OB', 'team');
		$ots = $this->get_req('OT');
		$ons = $this->get_req('ON');
		$tabName = "ob";
		return view('approval_list', ['obs' => $obs, 'ots' => $ots, 'ons' => $ons, 'tabName' => $tabName]);		
    }
	
	// sorting ob request by date
	public function sort_ob_date(){
		$obs = $this->get_req_sort('OB', 'starting_date');
		$ots = $this->get_req('OT');
		$ons = $this->get_req('ON');
		$tabName = "ob";
		return view('approval_list', ['obs' => $obs, 'ots' => $ots, 'ons' => $ons, 'tabName' => $tabName]);		
    }
	
	// sorting ot request by name
	public function sort_ot_name(){
		$obs = $this->get_req('OB');
		$ots = $this->get_req_sort('OT', 'name');
		$ons = $this->get_req('ON');
		$tabName = "ot";
		return view('approval_list', ['obs' => $obs, 'ots' => $ots, 'ons' => $ons, 'tabName' => $tabName]);		
    }
	
	// sorting ot request by team
	public function sort_ot_team(){
		$obs = $this->get_req('OB');
		$ots = $this->get_req_sort('OT', 'team');
		$ons = $this->get_req('ON');
		$tabName = "ot";
		return view('approval_list', ['obs' => $obs, 'ots' => $ots, 'ons' => $ons, 'tabName' => $tabName]);		
    }
	
	// sorting ot request by date
	public function sort_ot_date(){
		$obs = $this->get_req('OB');
		$ots = $this->get_req_sort('OT', 'starting_date');
		$ons = $this->get_req('ON');
		$tabName = "ot";
		return view('approval_list', ['obs' => $obs, 'ots' => $ots, 'ons' => $ons, 'tabName' => $tabName]);		
    }
	
	// sorting on request by name
	public function sort_on_name(){
		$obs = $this->get_req('OB');
		$ots = $this->get_req('OT');
		$ons = $this->get_req_sort('ON', 'name');
		$tabName = "on";
		return view('approval_list', ['obs' => $obs, 'ots' => $ots, 'ons' => $ons, 'tabName' => $tabName]);		
    }
	
	// sorting on request by team
	public function sort_on_team(){
		$obs = $this->get_req('OB');
		$ots = $this->get_req('OT');
		$ons = $this->get_req_sort('ON', 'team');
		$tabName = "on";
		return view('approval_list', ['obs' => $obs, 'ots' => $ots, 'ons' => $ons, 'tabName' => $tabName]);	
    }
	
	// sorting ot request by date
	public function sort_on_date(){
		$obs = $this->get_req('OB');
		$ots = $this->get_req('OT');
		$ons = $this->get_req_sort('ON', 'starting_date');
		$tabName = "on";
		return view('approval_list', ['obs' => $obs, 'ots' => $ots, 'ons' => $ons, 'tabName' => $tabName]);		
    }
	
	// approve/deny/endorse request
	public function approve_request(Request $request){
		$time=Carbon::now();
		$time=$time->toAtomString();
		$input = $request->all();
		$requests = DB::table('request')
				-> where('request_id', $input['request_id'])
				->first();
		$transition = new Transition;
		$transition->process_id = $requests->process_id;
		$transition->current_state_id = $requests->status;
		$state = new State;
		$state->state_type_id = $input['action'];
		$state->process_id = $requests->process_id;
		$state->name = \Auth::user()->id.'_'.$time;
		$saved = $state->save();
		if(!$saved){
			App::abort(500, 'Error');
		}
		$transition->next_state_id = $state->state_id;
		$saved = $transition->save();
		if(!$saved){
			App::abort(500, 'Error');
		}
		$request_note = new RequestNote;
		$request_note->request_id = $requests->request_id;
		$request_note->user_id = \Auth::user()->id;
		$request_note->note = $input['comment'];
		$saved = $request_note->save();
		if(!$saved){
			App::abort(500, 'Error');
		}
		$selected = Input::get('selected');
		if(is_array($selected)){
			$approved = implode(",", $selected);
		}
		$req = DB::table('request')
				-> where('request_id', $input['request_id']);
		if($requests->type=="OB"){
			$req -> update(['status' => $transition->next_state_id]);
			return Redirect::to('/aplist');
		}
		elseif($requests->type=="OT"){
			$req -> update(['status' => $transition->next_state_id, 'approved_dates' =>$approved]);
			return Redirect::to('/aplist#ot');
		}
		else{
			$req -> update(['status' => $transition->next_state_id, 'approved_dates' =>$approved]);
			return Redirect::to('/aplist#on');
		}
	}
}
