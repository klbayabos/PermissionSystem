<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\LengthAwarePaginator;
class AccountController extends Controller
{
	public function __construct(){
        $this->middleware('auth');
    }
	
	public function view_add_employee(){
		$team = DB::table('team')
					->get();
		$type = DB::table('type')
					->get();
		return view('add_emp', ['team' => $team, 'type' => $type]);
	}
	// display view of managing account
	public function view_acc(){
		// get all users
		$accounts = DB::table('users')
					->leftJoin('team', 'users.team_id', '=', 'team.team_id')
					->leftJoin('type', 'users.type_id', '=', 'type.type_id')
					->select('team.name as team', 'users.*', 'type.name as type')
					->paginate(10);
		$num_acc = 'null';
		return view('manage_acc', ['accounts' => $accounts, 'num_acc' => $num_acc]);		// view of managing account (**approvers/hr/admin only)
    }
	
	// display view of search results
	public function search_word(Request $request){
		$keywords = $request['searchword'];								// get keyword typed by the user
		$isoic = $request['isoic'];
		$keyword = explode(" ", $keywords);
		foreach ($keyword as $key=>$value){
			$keyword[$key] = '%'.$value.'%';
		}
		// search related keywords from the database
		if (!empty($keyword)) {
			$counter=0;
			$accounts = User::leftJoin('type', 'users.type_id', '=', 'type.type_id')
					-> leftJoin('team', 'users.team_id', '=', 'team.team_id')
					-> select('users.*','type.name AS type','team.name AS team')
					-> where('users.name','LIKE',$keyword[0])
					-> orWhere('type.name','LIKE',$keyword[0])
					-> orWhere('team.name','LIKE',$keyword[0])
					-> orWhere('email','LIKE',$keyword[0]);
			foreach($keyword as $keyword){
				if ($counter++ == 0){
					continue;
				}
				$accounts -> orWhere('users.name','LIKE',$keyword)
							-> orWhere('type.name','LIKE',$keyword)
							-> orWhere('team.name','LIKE',$keyword)
							-> orWhere('email','LIKE',$keyword);
			}
			if($isoic=='yes'){
				$oics = User::where('isOIC', 'yes')
						->get();
				$accounts = $accounts 
						-> where('isOIC', 'no')
						->get();
				$accounts = $oics->merge($accounts);
				$accounts = new LengthAwarePaginator($accounts, 10, 1);
				$num_acc = count($accounts)+1;
				return view('manage_acc', ['accounts' => $accounts, 'num_acc' => $num_acc]); // view of managing account (**approvers/hr/admin only)
			}
			$accounts = $accounts -> paginate(10);
			$num_acc = count($accounts)+1;
			return view('manage_acc', ['accounts' => $accounts, 'num_acc' => $num_acc]); // view of managing account (**approvers/hr/admin only)
        }
    }
	
	// when deleting/disabling a user from DB
	public function del_user($id = null){
		// tag as disabled
		DB::table('users')
			->where('id', $id)
			->update([ 'tag' => 'disabled' ]);
			
		// delete entries in process table
		$a = DB::table('process')
			->join('request', 'request.process_id', '=', 'process.process_id')
			->where('request.id', $id)
			->delete();
			
		Session::flash('manage_acc_msg', 'The user has been disabled!');
		return Redirect::to('/acc');
	}
	
	// when activating/enabling a user from DB
	public function activate_user($id = null){
		// tag as enabled
		DB::table('users')
			->where('id', $id)
			->update([ 'tag' => 'enabled' ]);
			
		Session::flash('manage_acc_msg', 'The user\'s account has been activated!');
		return Redirect::to('/acc');
	}
	
	// when adding a user (employee) to DB
	public function add_employee(Request $request){
		$input = $request->all();
		
		// check if account exists before adding new employee:
		if($this->check_duplicate_email($input['emp_email']) == null){
			$user = new User;
			$user->name = $input['emp_name'];
			$user->email = $input['emp_email'];
			$user->type_id = $input['emp_type'];
			$user->team_id = $input['emp_team'];
			$user->save();
			
			Session::flash('manage_acc_msg', 'The new user has been added!');
			return Redirect::to('/acc');
		}
		else{
			Session::flash('add_emp_msg', 'Duplicate Email! The email entered is already in the database');
			return Redirect::to('/add_emp');
		}
	}
	
	// get user to be edited from DB
	public function change_info_view($id = null){
		$team = DB::table('team')
					->get();
		$type = DB::table('type')
					->get();
		$chosen_user = DB::table('users')->where('id', $id)->first();
		
		return view('edit_info', ['chosen_user' => $chosen_user, 'team' => $team, 'type'=> $type]);
	}
	
	// edit user's (employee) info and update in DB
	public function edit_employee(Request $request){
		$input = $request->all();
		// check if account exists before editing email of employee:
		if($this->check_duplicate_eadd($input['new_email'], $input['emp_id']) == null){
			// update info in DB
			$chosen_user = DB::table('users')
							->where('id', $input['emp_id'])
							->update([ 'name' => $input['new_name'] , 'email' => $input['new_email'] , 'type_id' => $input['new_type'] , 'team_id' => $input['new_team'] ]);
			Session::flash('manage_acc_msg', "The user's info has been edited!");
			return Redirect::to('/acc');
		}
		else{
			Session::flash('edit_info_msg', 'Duplicate Email! The email entered is already in the database');
			$chosen_user = DB::table('users')->where('id', $input['emp_id'])->first();;
			return view('edit_info', ['chosen_user' => $chosen_user]);
		}
	}
	
	// check duplicate email when adding an employee
	public function check_duplicate_email($e_add){
		$temp = DB::table('users')
					->where('email', $e_add)
					->first();
		return $temp;
	}
	
	// check duplicate email when editing the email of an employee
	public function check_duplicate_eadd($e_add, $e_id){
		$temp = DB::table('users')
					->where('email', $e_add)
					->where('id', '!=', $e_id)
					->first();
		return $temp;
	}
	
	// return user data to be made oic
	public function make_oic($id){
		$user = DB::table('users')
				->leftJoin('team','users.team_id','=','team.team_id')
				->leftJoin('type','users.type_id','=','type.type_id')
				->select('users.*','team.name AS team','type.name AS type')
				->where('id', $id)
				->first();
		return view('oic_time', ['user' => $user]);
	}
	
	// make user oic with submitted data
	public function submit_oic(Request $request){
		$input = $request->all();
		$user = DB::table('users')
				-> where('id', $input['id'])
				-> update(['OIC_starting_date' => $input['fromdate'], 'OIC_end_date' => $input['todate']]);
		return Redirect::to('/acc');
	}
	
	// view all stats
	public function view_stats(Request $request){
		$input = $request->all();
		if(isset($input['year']))
			$year = $input['year'];
		else
			$year = date('Y');
		if(isset($input['user'])){
			$userid = $input['user'];
			$user = DB::table('users')
					->where('id', $userid)
					->first();
			
		}
		if(isset($input['team'])){
			$teamid = $input['team'];
			$team = DB::table('team')
					->where('team_id', $teamid)
					->first();
		}
		$approved = DB::table('request_approval')
				->leftJoin('request', 'request_approval.request_id', '=', 'request.request_id')
				->leftJoin('approved_dates', 'request_approval.request_aid', '=', 'approved_dates.request_aid');
		if(isset($input['user']))
			$approved = $approved ->where('id', $userid);
		elseif(isset($input['team']))
			$approved = $approved ->where('id', $teamid);
		$approved = $approved ->where('isApproved', 'approved');
		$year1 = $approved
				->select(DB::raw('YEAR(approved_date) as year'), DB::raw('count(*) as total'))
				->groupBy(DB::raw('YEAR(approved_date)'))
				->get();
		$quarter = $approved
				->select(DB::raw('QUARTER(approved_date) as quarter'), DB::raw('count(*) as total'))
				->whereYear('approved_date','=',$year)
				->groupBy(DB::raw('QUARTER(approved_date)'))
				->get();
		$month = $approved
				->select(DB::raw('MONTH(approved_date) as month'), DB::raw('count(*) as total'))
				->whereYear('approved_date','=',$year)
				->groupBy(DB::raw('MONTH(approved_date)'))
				->get();
		$week = $approved
				->select(DB::raw('WEEK(approved_date) as week'), DB::raw('count(*) as total'))
				->whereYear('approved_date','=',$year)
				->groupBy(DB::raw('WEEK(approved_date)'))
				->get();
		$min=DB::table('approved_dates')
			->min(DB::raw('YEAR(approved_date)'));
		$max=DB::table('approved_dates')
			->max(DB::raw('YEAR(approved_date)'));
		$range=$max-$min;
		$yearly = array_fill(0, $range, 0);
		$quarterly = array_fill(0, 3, 0);
		$monthly = array_fill(0, 11, 0);
		$weekly = array_fill(0, 51, 0);
		foreach($year1 as $years){
			$yearly[$years->year-$min] = $years->total;
		}
		foreach($quarter as $quarters){
			$quarterly[$quarters->quarter-1] = $quarters->total;
		}
		foreach($month as $months){
			$monthly[$months->month-1] = $months->total;
		}
		foreach($week as $weeks){
			$weekly[$weeks->week-1] = $weeks->total;
		}
		$teams=DB::table('team')
			->get();
		if(isset($input['user']))
			return view('stats', ['user'=>$user, 'yearly'=>$yearly, 'quarterly' =>$quarterly, 'monthly'=>$monthly, 'weekly'=>$weekly, 'year'=>$year, 'min'=>$min, 'max'=>$max]);
		if(isset($input['team'])){
			return view('stats', ['team'=>$team, 'yearly'=>$yearly, 'quarterly' =>$quarterly, 'monthly'=>$monthly, 'weekly'=>$weekly, 'year'=>$year, 'min'=>$min, 'max'=>$max, 'teams'=>$teams]);
		}
		return view('stats', ['yearly'=>$yearly, 'quarterly' =>$quarterly, 'monthly'=>$monthly, 'weekly'=>$weekly, 'year'=>$year, 'min'=>$min, 'max'=>$max, 'teams'=>$teams]);
	}
}
