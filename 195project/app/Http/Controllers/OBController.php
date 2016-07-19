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
use App\OBRequestData;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OBController extends Controller{
	
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
		DB::table('request')
			->where('request_id', $id)
			->delete();
		Session::flash('emp_ob_msg', 'The official business request has been deleted');
		return Redirect::to('/officialbusiness');		// view your ob requests
    }

	// get details of ob request from DB
	public function get_obdetails_DB($request_id){
		$ob = DB::table('request')
				->leftJoin('ob_request_data', 'request.request_id', '=', 'ob_request_data.request_id')
				->leftJoin('users', 'request.id', '=', 'users.id')
				->select('request.*','ob_request_data.to','ob_request_data.from', 'users.*')
				->where('request.request_id', $request_id)
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
				
		$array_ans = array($ob, $endorser, $head, $tl, $sv);
		return $array_ans;
	}
	
	//view the details of an OB request
	public function view_OB_details($request_id = NULL){
		$val = $this->get_obdetails_DB($request_id);
		$ob = $val[0];
		$endorser = $val[1];
		$head = $val[2];
		$tl = $val[3];
		$sv = $val[4];
		return view('my_ob', ['ob' => $ob, 'endorser' => $endorser, 'head' => $head, 'tl' => $tl, 'sv' => $sv,'request_id' => $request_id]);
	}
	
	
	//view the details of an OB request for approval
	public function view_OB_apdetails($request_id = NULL){
		$val = $this->get_obdetails_DB($request_id);
		$ob = $val[0];
		$endorser = $val[1];
		$head = $val[2];
		$tl = $val[3];
		$sv = $val[4];
		return view('ob_approval_details', ['ob' => $ob, 'endorser' => $endorser, 'head' => $head, 'tl' => $tl, 'sv' => $sv,'request_id' => $request_id]);
	}
	
	// view user's ob requests
	public function view_your_OB(){
		$obs = DB::select("SELECT * FROM (SELECT team_id, name AS team FROM team) AS der1 NATURAL JOIN (SELECT * FROM request WHERE type='Official Business' and id='".$this->get_currentUser()->id."') as der2 NATURAL JOIN ob_request_data");
		if($obs == null){
			Session::flash('emp_ob_msg', 'You have no official business requests');
		}
		return view('emp_ob', ['obs' => $obs]);
	}
	
	// check if the team has a team leader or supervisor or approver
	public function check_tlsvap(){
		$var = DB::table('users')
					->where('team_id', \Auth::user()->team_id)
					->whereIn('type_id', array(3, 4, 6))
					->get();
		return $var;
	}
	
	// when submitting your ob request form
	public function get_OBrequest(Request $request){
		$tlsvap = $this->check_tlsvap();

		$input = $request->all();
		$req = new RequestApplication;
		$req->id = \Auth::user()->id;
		$req->type = "Official Business";
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
		$obdata = new OBRequestData;
		$obdata->request_id = $req->request_id;
		$obdata->to = $input['to'];
		$obdata->from = $input['from'];
		$saved = $obdata->save();
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
					
			// $this->notify_email('head');				// notify head (note, pag final na i-uncomment ito)
		}
		else{
			// $this->notify_email('endorsers');		// notify endorsers (note, pag final na i-uncomment ito)
		}
		
		Session::flash('emp_ob_msg', 'Your OB request has been submitted!');
		return Redirect::to('/officialbusiness');			
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
				$content = "Good day!\r\nThis is to notify you that ".\Auth::user()->name." has filed an official business request.";
				$data = [
				   'email' => $email,
				   'subject' => 'eUP - Official Business Request',
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
