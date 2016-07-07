<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Process;
use App\State;
use App\RequestApplication;
use App\OBRequestData;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class RequestController extends Controller{
	
	public function __construct(){
        $this->middleware('auth');
    }
	
	// get requests
	public function get_req($type){
		$req = DB::table('request')
					->leftJoin('users', 'request.id', '=', 'users.id')
					->leftJoin('team', 'users.team_id', '=', 'team.team_id')
					->leftJoin('state','state.state_id', '=', 'request.status')
					->leftJoin('state_type','state_type.state_type_id', '=', 'state.state_type_id')
					->select('team.name as team', 'request.*','users.id','users.name','state_type.name as state')
					->where('type', $type)
					->get();
		return $req;
	}
	
	// get requests sorted by either name or team 
	public function get_req_sort($type, $group){
		$req = DB::table('request')
					->leftJoin('users', 'request.id', '=', 'users.id')
					->leftJoin('team', 'users.team_id', '=', 'team.team_id')
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
}
