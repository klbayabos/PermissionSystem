<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use Session;
use App\State;
use App\Process;
use App\Action;
use App\RequestApplication;
use App\RequestEndorsement;
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
	public function del_on($id = null){
		DB::table('request')
			->where('request_id', $id)
			->delete();
		Session::flash('emp_on_msg', 'The overtime request has been deleted');
		return Redirect::to('/overnight');				// view your on requests
    }
	
	// get details of on request from DB
	public function get_ondetails_DB($request_id){
		$on = DB::table('request')
					->where('request_id', $request_id)
					->where('type', 'Overnight')
					->first();
					
		$endorser = DB::table('request_endorsement')
					->where('request_id', $request_id)
					->first();
				
		$head = DB::table('request_approval')
					->where('request_id', $request_id)
					->first();
					
		// get team leader
		$tl = DB::table('team')
				->join('users', 'team.team_id', '=', 'users.team_id')
				->where('users.team_id', \Auth::user()->team_id)
				->where('users.type_id', 6)
				->first();
		
		// get supervisor
		$sv = DB::table('team')
				->join('users', 'team.team_id', '=', 'users.team_id')
				->where('users.team_id', \Auth::user()->team_id)
				->where('users.type_id', 4)
				->first();
				
		$array_ans = array($on, $endorser, $head, $tl, $sv);
		return $array_ans;
	}
	
	//view the details of an ON request
	public function view_ON_details($request_id = NULL){
		$val = $this->get_ondetails_DB($request_id);
		$on = $val[0];
		$endorser = $val[1];
		$head = $val[2];
		$tl = $val[3];
		$sv = $val[4];
		return view('my_on', ['on' => $on, 'endorser' => $endorser, 'head' => $head, 'tl' => $tl, 'sv' => $sv]);
	}	
	
	//view the details of an ON request for approval
	public function view_ON_apdetails($request_id = NULL){
		$val = $this->get_ondetails_DB($request_id);
		$on = $val[0];
		$endorser = $val[1];
		$head = $val[2];
		$tl = $val[3];
		$sv = $val[4];
		return view('on_approval_details', ['on' => $on, 'endorser' => $endorser, 'head' => $head, 'tl' => $tl, 'sv' => $sv, 'request_id' => $request_id]);
	}
	
	// view user's overnight requests
	public function view_your_ON(){
		$ons = DB::table('request')
					->where('id', \Auth::user()->id)
					->where('type', 'Overnight')
					->orderBy('created_at','desc')
					->get();
		if($ons == null){
			Session::flash('emp_on_msg', 'You have no overnight requests');
		}
		return view('emp_on', ['ons' => $ons]);
	}
	// when submitting your on request form
	public function get_ONrequest(Request $request){
		$input = $request->all();
		$req = new RequestApplication;
		$req->id = \Auth::user()->id;
		$req->type = "Overnight";
		$req->team_id = \Auth::user()->team_id;
		$req->starting_date = $input['fromdate'];
		$req->end_date = $input['todate'];
		$req->starting_time = $input['fromtime'];
		$req->end_time = $input['totime'];
		$req->request_purpose = $input['purpose'];
		$req->status = "Submitted";
		$saved = $req->save();
		if(!$saved){
			App::abort(500, 'Error');
		}
		
		if(\Auth::user()->type_id == 3 || \Auth::user()->type_id == 6){		// team leader or approver filing a request
			$req_endorsed = new RequestEndorsement;
			$req_endorsed->request_id = $req->request_id;
			$req_endorsed->isEndorsed = "endorsed";
			$req_endorsed->endorser = "System";
			$req_endorsed->comment = "Automatic endorsement";
			$saved = $req_endorsed->save();
			
			$req = DB::table('request')
				->where('request_id', $req_endorsed->request_id)
				->update(['status' => "Endorsed for approval"]);
					
			// $this->notify_head('head');		// notify head (note, pag final na i-uncomment ito)
		}
		else{
			continue;
			// $this->notify_email('endorsers');		// notify endorsers (note, pag final na i-uncomment ito)
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
	
	// notify team leader/supervisor/approver or head thru email after making a request
	public function notify_email($type){
		// get team leader/supervisor/approver
		if($type == 'endorsers'){
			$person = DB::table('team')
				->join('users', 'team.team_id', '=', 'users.team_id')
				->where('users.team_id', \Auth::user()->team_id)
				->where(function ($query) {
						$query->orWhere('users.type_id', 3)
							->orWhere('users.type_id', 4)
							->orWhere('users.type_id', 6);
					})
				->get();
		}
		elseif($type == 'head'){
			$person = DB::table('users')
					->where('type_id', 1)
					->get();
		}
				
		foreach($person as $person){	
			try{
				$email = $person->email;
				Mail::raw("Good day!\r\nThis is to notify you that ".\Auth::user()->name." has filed an overnight request.", function ($message) use ($email){	
					$message->from('up.oboton@gmail.com', 'Do not reply to this email');
					$message->to($email);
					$message->subject('eUP - Overtime Request');
				});
			}
			catch (\Exception $e){
				continue;
			}
		}
	}
}
