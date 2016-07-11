<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use Session;
use App\Process;
use App\State;
use App\RequestApplication;
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
		DB::table('process')
			->join('request', 'request.process_id', '=', 'process.process_id')
			->where('request_id', $id)
			->delete();
		Session::flash('emp_ot_msg', 'The overtime request has been deleted');
		return Redirect::to('/overtime');				// view your overtime requests
    }
	
	// get details of ot request from DB
	public function get_otdetails_DB($request_id){
		$ot = DB::table('request')
					->leftJoin('users', 'request.id', '=', 'users.id')
					->leftJoin('state','state.state_id', '=', 'request.status')
					->leftJoin('state_type','state_type.state_type_id', '=', 'state.state_type_id')
					->select('request.*','users.name','state_type.name as state')
					->where('request_id', $request_id)
					->first();
		$ot_notes = DB::table('request_note')
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
				
		$array_ans = array($ot, $ot_notes, $tl, $sv);
		return $array_ans;
	}
	
	//view the details of an OT request
	public function view_OT_details($request_id = NULL){
		$val = $this->get_otdetails_DB($request_id);
		$ot = $val[0];
		$ot_notes = $val[1];
		$tl = $val[2];
		$sv = $val[3];
		return view('my_ot', ['ot' => $ot, 'otnotes' => $ot_notes, 'tl' => $tl, 'sv' => $sv]);
	}

	//view the details of an OT request for approval
	public function view_OT_apdetails($request_id = NULL){
		$val = $this->get_otdetails_DB($request_id);
		$ot = $val[0];
		$ot_notes = $val[1];
		$tl = $val[2];
		$sv = $val[3];
		return view('ot_approval_details', ['ot' => $ot, 'otnotes' => $ot_notes, 'tl' => $tl, 'sv' => $sv, 'request_id' => $request_id]);
	}
	
	// view user's overtime requests
	public function view_your_OT(){
		$ots = DB::table('request')
					->where('id', \Auth::user()->id)
					->where('type', 'OT')
					->get();
		if($ots == null){
			Session::flash('emp_ot_msg', 'You have no overtime requests');
		}
		$count = count($ots);
		return view('emp_ot', ['ots' => $ots, 'count' => $count]);
	}
	
	// when submitting your ot request form
	public function get_OTrequest(Request $request){
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
		$req->type = "OT";
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
						$query->orWhere('users.type_id', 4)
							->orWhere('users.type_id', 5)
							->orWhere('users.type_id', 7);
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
