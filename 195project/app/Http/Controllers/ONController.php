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
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ONController extends Controller{
	
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
					->leftJoin('users', 'request.id', '=', 'users.id')
					->select('request.*', 'users.id', 'users.name')
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
		
		$dates = DB::table('approved_dates')
					->join('request_approval', 'request_approval.request_aid', '=', 'approved_dates.request_aid')
					->where('request_approval.request_id', $request_id)
					->get();

		$array_ans = array($on, $endorser, $head, $tl, $sv, $dates);
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
		$dates = $val[5];
		return view('my_on', ['on' => $on, 'endorser' => $endorser, 'head' => $head, 'tl' => $tl, 'sv' => $sv, 'dates' => $dates]);
	}	
	
	//view the details of an ON request for approval
	public function view_ON_apdetails($request_id = NULL){
		$val = $this->get_ondetails_DB($request_id);
		$on = $val[0];
		$endorser = $val[1];
		$head = $val[2];
		$tl = $val[3];
		$sv = $val[4];
		$dates = $val[5];
		return view('on_approval_details', ['on' => $on, 'endorser' => $endorser, 'head' => $head, 'tl' => $tl, 'sv' => $sv, 'request_id' => $request_id, 'dates' => $dates]);
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
	
	// check if the team has a team leader or supervisor or approver
	public function check_tlsvap(){
		$var = DB::table('users')
					->where('team_id', \Auth::user()->team_id)
					->whereIn('type_id', array(3, 4, 6))
					->get();
		return $var;
	}

	// when submitting your on request form
	public function get_ONrequest(Request $request){
		$tlsvap = $this->check_tlsvap();

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

		// team leader or approver filing a request OR when the team has no tl/sv/approver
		if(\Auth::user()->type_id == 3 || \Auth::user()->type_id == 6 || empty($tlsvap)){		
			$req_endorsed = new RequestEndorsement;
			$req_endorsed->request_id = $req->request_id;
			$req_endorsed->isEndorsed = "endorsed";
			$req_endorsed->endorser = "System";
			$req_endorsed->comment = "Automatic endorsement";
			$saved = $req_endorsed->save();
			
			$req = DB::table('request')
				->where('request_id', $req_endorsed->request_id)
				->update(['status' => "Endorsed for approval"]);
					
			$this->notify_email('head');		// notify head (note, pag final na i-uncomment ito)
		}
		else{
			$this->notify_email('endorsers');		// notify endorsers (note, pag final na i-uncomment ito)
		}
		
		Session::flash('emp_on_msg', 'Your overnight request has been submitted!');
		return Redirect::to('/overnight');			
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
			 $content = "Good day!\r\nThis is to notify you that ".\Auth::user()->name." has filed an Overnight Request. You may now endorse the request for approval or disapproval.";
		}
		elseif($type == 'head'){
			$person = DB::table('users')
					->where('type_id', 1)
					->orWhere('isOIC', 'yes')
					->get();
			 $content = "Good day!\r\nThis is to notify you that ".\Auth::user()->name." has filed an Overnight Request. You may now approve or deny the request.";

		}
				
		foreach($person as $person){
			try{
				$email = $person->email;
				$data = [
				   'email' => $email,
				   'subject' => 'eUP - Overnight Request',
				   'content' => $content
				];
				Mail::send("emails.approval", $data, function ($message) use ($data){	
					$message->from('up.oboton@gmail.com', 'Do not reply to this email');
					$message->to($data['email']);
					$message->subject($data['subject']);
				});			
			}
			catch (\Exception $e){
				continue;
			}
		}
	}
}
