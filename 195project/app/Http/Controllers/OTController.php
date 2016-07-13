<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use Session;
use App\Process;
use App\Action;
use App\State;
use App\RequestApplication;
use App\RequestEndorsement;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
                /** @var $query Illuminate\Database\Query\Builder  */

class OTController extends Controller{
	
	public function __construct(){
        $this->middleware('auth');
    }
	
	// display view of otform
	public function view_otform(){
		$user = DB::table('users')
					->leftJoin('team', 'users.team_id', '=', 'team.team_id')
					->select('team.name as team', 'users.*')
					->where('id', \Auth::user()->id)
					->first();
		return view('otform', ['user' => $user]);		// view the application for overtime form 
    }
	
	// when deleting your ot request
	public function del_ot($id = null){
		DB::table('request')
			->where('request_id', $id)
			->delete();
		Session::flash('emp_ot_msg', 'The overtime request has been deleted');
		return Redirect::to('/overtime');				// view your overtime requests
    }
	
	// get details of ot request from DB
	public function get_otdetails_DB($request_id){
		$ot = DB::table('request')
					->leftJoin('users', 'request.id', '=', 'users.id')
					->select('request.*', 'users.id', 'users.name')
					->where('request_id', $request_id)
					->where('type', 'Overtime')
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
				
		$array_ans = array($ot, $endorser, $head, $tl, $sv);
		return $array_ans;
	}
	
	//view the details of an OT request
	public function view_OT_details($request_id = NULL){
		$val = $this->get_otdetails_DB($request_id);
		$ot = $val[0];
		$endorser = $val[1];
		$head = $val[2];
		$tl = $val[3];
		$sv = $val[4];
		return view('my_ot', ['ot' => $ot, 'endorser' => $endorser, 'head' => $head, 'tl' => $tl, 'sv' => $sv]);
	}

	//view the details of an OT request for approval
	public function view_OT_apdetails($request_id = NULL){
		$val = $this->get_otdetails_DB($request_id);
		$ot = $val[0];
		$endorser = $val[1];
		$head = $val[2];
		$tl = $val[3];
		$sv = $val[4];
		return view('ot_approval_details',  ['ot' => $ot, 'endorser' => $endorser, 'head' => $head, 'tl' => $tl, 'sv' => $sv, 'request_id' => $request_id]);
	}
	
	// view user's overtime requests
	public function view_your_OT(){
		$ots = DB::table('request')
					->where('id', \Auth::user()->id)
					->where('type', 'Overtime')
					->orderBy('created_at','desc')
					->get();
		if($ots == null){
			Session::flash('emp_ot_msg', 'You have no overtime requests');
		}
		$count = count($ots);
		return view('emp_ot', ['ots' => $ots, 'count' => $count]);
	}
	
	// when submitting your ot request form
	public function get_OTrequest(Request $request){
		$input = $request->all();
		$req = new RequestApplication;
		$req->id = \Auth::user()->id;
		$req->type = "Overtime";
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
			$req_endorsed->comment = "waiting for head approval";
			$saved = $req_endorsed->save();
			
			$req = DB::table('request')
				->where('request_id', $req_endorsed->request_id)
				->update(['status' => "Endorsed for approval"]);
		}
		
		//$this->send_to_endorsers();		// notify endorsers (note, pag final na i-uncomment ito)
		
		Session::flash('emp_ot_msg', 'Your OT request has been submitted!');
		return Redirect::to('/overtime');			
    }
	
	// when approving or denying an ot request
	public function ot_approval_action(Request $request){
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
	
	// notify team leader/supervisor/approver thru email after making a request
	public function send_to_endorsers(){
		// get team leader/supervisor/approver
		$endorsers = DB::table('team')
				->join('users', 'team.team_id', '=', 'users.team_id')
				->where('users.team_id', \Auth::user()->team_id)
				->where(function ($query) {
						$query->orWhere('users.type_id', 3)
							->orWhere('users.type_id', 4)
							->orWhere('users.type_id', 6);
					})
				->get();
		foreach($endorsers as $endorsers){	
			try{
				$email = $endorsers->email;
				Mail::raw("Good day!\r\nThis is to notify you that ".\Auth::user()->name." has filed an overtime request.", function ($message) use ($email){	
					$message->from('up.oboton@gmail.com', 'Do not reply to this email');
					$message->to($email);
					$message->subject('UP ITDC - Overtime Request');
				});
			}
			catch (\Exception $e){
				continue;
			}
		}
	}
	
	
	
}
