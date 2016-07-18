<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use Session;
use App\RequestEndorsement;
use App\RequestApproval;
use App\RequestApplication;
use App\ApprovedDate;
use App\OBRequestData;
use App\Http\Requests;
use Input;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class RequestController extends Controller{
	
	public function __construct(){
        $this->middleware('auth');
    }
	
	public function get_req($type, $group="created_at", $order="desc"){
		// if both OIC and (approver or supervisor or team leader)
		if((\Auth::user()->type_id == 3 || \Auth::user()->type_id == 4 || \Auth::user()->type_id == 6) && \Auth::user()->isOIC == "yes"){
			$req = DB::table('request')
					->leftJoin('users', 'request.id', '=', 'users.id')
					->leftJoin('team', 'users.team_id', '=', 'team.team_id')
					->select('team.name as team', 'request.*','users.id','users.name')
					->where('type', $type)
					->where(function ($query) {
							$query->where(function ($query2) {
										$query2->where('status', 'Submitted')	
												->where('team.team_id', '=', \Auth::user()->team_id);			
										})
								->orWhere('status', 'Endorsed for approval');
					})
					->orderBy($group, $order)
					->get();
		}
		
		// for approval
		elseif(\Auth::user()->type_id == 1 || \Auth::user()->isOIC == "yes"){		// if head or oic
			$req = DB::table('request_endorsement')
						->join('request', 'request.request_id', '=', 'request_endorsement.request_id')
						->join('users', 'request.id', '=', 'users.id')
						->join('team', 'users.team_id', '=', 'team.team_id')
						->select('team.name as team', 'request.*','users.id','users.name')
						->where('request.type', $type)
						->where('request_endorsement.isEndorsed', 'endorsed')
						->where('request.status', 'Endorsed for approval')
						->orderBy($group, $order)
						->get();
					
		}
		
		// for endorsement
		else{
			$req = DB::table('request')
					->leftJoin('users', 'request.id', '=', 'users.id')
					->leftJoin('team', 'users.team_id', '=', 'team.team_id')
					->where('team.team_id', '=', \Auth::user()->team_id)
					//->where('request.id', '!=', \Auth::user()->id) 				//remove own request for endorsement
					->select('team.name as team', 'request.*','users.id','users.name')
					->where('status', 'Submitted')
					->where('type', $type)
					->orderBy($group, $order)
					->get();
		}
		return $req;
	}
	
	public function view_all(){
		$ots = $this->get_req('Overtime');
		$obs = $this->get_req('Official Business');
		$ons = $this->get_req('Overnight');
		return view('approval_list', ['obs' => $obs, 'ots' => $ots, 'ons' => $ons]);
	}
	
	// sorting ob request by name
	public function sort_ob_name(){
		$obs = $this->get_req('Official Business', 'name', 'asc');
		$ots = $this->get_req('Overtime');
		$ons = $this->get_req('Overnight');
		$tabName = "ob";
		return view('approval_list', ['obs' => $obs, 'ots' => $ots, 'ons' => $ons, 'tabName' => $tabName]);		
    }
	
	// sorting ob request by team
	public function sort_ob_team(){
		$obs = $this->get_req('Official Business', 'team', 'asc');
		$ots = $this->get_req('Overtime');
		$ons = $this->get_req('Overnight');
		$tabName = "ob";
		return view('approval_list', ['obs' => $obs, 'ots' => $ots, 'ons' => $ons, 'tabName' => $tabName]);		
    }
	
	// sorting ob request by date
	public function sort_ob_date(){
		$obs = $this->get_req('Official Business', 'starting_date', 'asc');
		$ots = $this->get_req('Overtime');
		$ons = $this->get_req('Overnight');
		$tabName = "ob";
		return view('approval_list', ['obs' => $obs, 'ots' => $ots, 'ons' => $ons, 'tabName' => $tabName]);		
    }
	
	// sorting ot request by name
	public function sort_ot_name(){
		$obs = $this->get_req('Official Business');
		$ots = $this->get_req('Overtime', 'name', 'asc');
		$ons = $this->get_req('Overnight');
		$tabName = "ot";
		return view('approval_list', ['obs' => $obs, 'ots' => $ots, 'ons' => $ons, 'tabName' => $tabName]);		
    }
	
	// sorting ot request by team
	public function sort_ot_team(){
		$obs = $this->get_req('Official Business');
		$ots = $this->get_req('Overtime', 'team', 'asc');
		$ons = $this->get_req('Overnight');
		$tabName = "ot";
		return view('approval_list', ['obs' => $obs, 'ots' => $ots, 'ons' => $ons, 'tabName' => $tabName]);		
    }
	
	// sorting ot request by date
	public function sort_ot_date(){
		$obs = $this->get_req('Official Business');
		$ots = $this->get_req('Overtime', 'starting_date', 'asc');
		$ons = $this->get_req('Overnight');
		$tabName = "ot";
		return view('approval_list', ['obs' => $obs, 'ots' => $ots, 'ons' => $ons, 'tabName' => $tabName]);		
    }
	
	// sorting on request by name
	public function sort_on_name(){
		$obs = $this->get_req('Official Business');
		$ots = $this->get_req('Overtime');
		$ons = $this->get_req('Overnight', 'name', 'asc');
		$tabName = "on";
		return view('approval_list', ['obs' => $obs, 'ots' => $ots, 'ons' => $ons, 'tabName' => $tabName]);		
    }
	
	// sorting on request by team
	public function sort_on_team(){
		$obs = $this->get_req('Official Business');
		$ots = $this->get_req('Overtime');
		$ons = $this->get_req('Overnight', 'team', 'asc');
		$tabName = "on";
		return view('approval_list', ['obs' => $obs, 'ots' => $ots, 'ons' => $ons, 'tabName' => $tabName]);	
    }
	
	// sorting ot request by date
	public function sort_on_date(){
		$obs = $this->get_req('Official Business');
		$ots = $this->get_req('Overtime');
		$ons = $this->get_req('Overnight', 'starting_date', 'asc');
		$tabName = "on";
		return view('approval_list', ['obs' => $obs, 'ots' => $ots, 'ons' => $ons, 'tabName' => $tabName]);		
    }
	
// approve/deny/endorse request
	public function request_action(Request $request){
		$input = $request->all();
		$req = DB::table('request')
				->where('request_id', $input['request_id']);
				
		if($input['action'] == 'endorse'){
			$req_endorsed = new RequestEndorsement;
			$req_endorsed->request_id = $input['request_id'];
			$req_endorsed->isEndorsed = "endorsed";
			$req_endorsed->endorser = \Auth::user()->name;
			$req_endorsed->comment = $input['comment1'];
			$saved = $req_endorsed->save();
			if(!$saved){
				App::abort(500, 'Error');
			}
			$req -> update(['status' => "Endorsed for approval"]);
			//$this->send_request_status($input['request_id'], $input['type'], 'endorse');	  // uncomment pag final na
			Session::flash('approval_list_msg', 'The '.$input['type'].' request has been endorsed for approval!');
		}
		elseif($input['action'] == 'endorse_deny'){
			$req_edenied = new RequestEndorsement;
			$req_edenied->request_id = $input['request_id'];
			$req_edenied->isEndorsed = "denied";
			$req_edenied->endorser = \Auth::user()->name;
			$req_edenied->comment = $input['comment1'];
			$saved = $req_edenied->save();
			if(!$saved){
				App::abort(500, 'Error');
			}
			$req -> update(['status' => "Endorsed for disapproval"]);
			//$this->send_request_status($input['request_id'], $input['type'], 'endorse_deny');	  // uncomment pag final na
			Session::flash('approval_list_msg', 'The '.$input['type'].' request has been endorsed for disapproval!');
		}
		elseif($input['action'] == 'approve'){
			$user = DB::table('request')
					->where('request_id', $input['request_id'])
					->leftJoin('users', 'request.id', '=', 'users.id')
					->first();
			$req_approved = new RequestApproval;
			$req_approved->request_id = $input['request_id'];
			$req_approved->type = $user->type;
			$req_approved->isApproved = "approved";
			//$req_approved->approved_dates = !empty($approved) ? "$approved" : "NULL";
			$req_approved->approver = \Auth::user()->name;
			$req_approved->comment = $input['comment2'];
			$saved = $req_approved->save();
			if(!$saved){
				App::abort(500, 'Error');
			}
			$req -> update(['status' => "Approved"]);
			
			// saving ot & on dates
			if($input['type'] == "Overtime" || $input['type'] == "Overnight"){
				$selected = Input::get('selected');
				if(is_array($selected)){
					//$approved = implode(",", $selected);
					foreach( $selected as $selected ){
						$approveddate = new ApprovedDate;
						$approveddate->request_aid = $req_approved->request_aid;
						$approveddate->approved_date = $selected;
						$saved = $approveddate->save();
						if(!$saved){
							App::abort(500, 'Error');
						}
					}
				}
				else{ // single date
					$approveddate = new ApprovedDate;
					$approveddate->request_aid = $req_approved->request_aid;
					$approveddate->approved_date = $input['singledate'];
					$saved = $approveddate->save();
					if(!$saved){
						App::abort(500, 'Error');
					}
				}
			}
			// saving ob dates
			else{
				if($input['ob_startdate'] != $input['ob_enddate']){	// multiple dates
					$array = $this->date_range(date("Y-m-d", strtotime($input['ob_startdate'])), date("Y-m-d", strtotime($input['ob_enddate'])), "+1 day", "Y-m-d");	
					//$approved = implode(",", $selected);
					foreach( $array as $array ){
						$approveddate = new ApprovedDate;
						$approveddate->request_aid = $req_approved->request_aid;
						$approveddate->approved_date = $array;
						$saved = $approveddate->save();
						if(!$saved){
							App::abort(500, 'Error');
						}
					}
				}
				else{ // single date
					$approveddate = new ApprovedDate;
					$approveddate->request_aid = $req_approved->request_aid;
					$approveddate->approved_date = $input['ob_startdate'];
					$saved = $approveddate->save();
					if(!$saved){
						App::abort(500, 'Error');
					}
				}
			}
			
			
			//$this->send_request_status($input['request_id'], $input['type'], 'approve');	  // uncomment pag final na
			Session::flash('approval_list_msg', 'The '.$input['type'].' request has been approved!');
		}
		elseif($input['action'] == 'head_deny'){
			$selected = Input::get('selected');
			$req_denied = new RequestApproval;
			$req_denied->request_id = $input['request_id'];
			$req_denied->isApproved = "denied";
			$req_denied->type = $user->type;
			//$req_denied->approved_dates = !empty($denied) ? "$denied" : "NULL";
			$req_denied->approver = \Auth::user()->name;
			$req_denied->comment = $input['comment2'];
			$saved = $req_denied->save();
			if(!$saved){
				App::abort(500, 'Error');
			}
			$req -> update(['status' => "Denied"]);
			//$this->send_request_status($input['request_id'], $input['type'], 'head_deny');	  // uncomment pag final na
			Session::flash('approval_list_msg', 'The '.$input['type'].' request has been denied!');
		}
				
		if($input['type']=="Official Business"){
			return Redirect::to('/aplist');
		}
		elseif($input['type']=="Overtime"){
			return Redirect::to('/aplist#ot');
		}
		else{
			return Redirect::to('/aplist#on');
		}
	}
	
	
	// get dates for ob
	public function date_range($first, $last, $step = '+1 day', $output_format = 'Y-m-d' ) {
		$dates = array();
		$current = strtotime($first);
		$last = strtotime($last);
		while( $current <= $last ) {
			$dates[] = date($output_format, $current);
			$current = strtotime($step, $current);
		}
		return $dates;
	}
	
	// notify user thru email after endorsing/approving/denying his request
	public function send_request_status($req_id, $type, $action){
		$user = DB::table('request')
				->where('request.request_id', $req_id)
				->join('users', 'request.id', '=', 'users.id')
				->select('users.email as email', 'users.*')
				->first();
				
		try{
			$email = $user->email;
			$subject = "eUP - ".$type." Request";
			if($action == "endorse"){
				$content = "Good day!\r\nThis is to notify you that your ".$type." Request has been endorsed for approval by ".\Auth::user()->name.".";
				// notify head
				$head = DB::table('users')
						->where('type_id', 1)
						->get();
						
				foreach($head as $head){	
					try{
						$subject = "eUP - ". $type ." Request";
						$heademail = $head->email;
						Mail::raw("Good day!\r\nThis is to notify you that ". $user->name ." has filed an ".$type." Request.", function ($message) use ($heademail, $subject){	
							$message->from('up.oboton@gmail.com', 'Do not reply to this email');
							$message->to($heademail);
							$message->subject($subject);
						});
						
					}
					catch (\Exception $e){
						continue;
					}
				}
			}
			elseif($action == "endorse_deny" || $action == "head_deny"){
				$content = "Good day!\r\nThis is to notify you that your ".$type." Request has been denied by ".\Auth::user()->name.".";
			}
			elseif($action == "approve"){
				$content = "Good day!\r\nThis is to notify you that your ".$type." Request has been approved by ".\Auth::user()->name.".";
			}
			
			Mail::raw($content, function ($message) use ($email, $subject){	
					$message->from('up.oboton@gmail.com', 'Do not reply to this email');
					$message->to($email);
					$message->subject($subject);
				});
		}
		catch (\Exception $e){
			continue;
		}
	}
	
}
