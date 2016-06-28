<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
class AccountController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
	// display view of managing account
	public function view_acc()
    {
		// get all users except {current user, admin} 
		$accounts = DB::table('users')
					->get();
		$num_acc = 'null';
		return view('manage_acc', ['accounts' => $accounts, 'num_acc' => $num_acc]);		// view of managing account (**approvers/hr/admin only)
    }
	
	// display view of search results
	public function search_name(Request $request)
    {
		$keyword = $request['searchword'];								// get keyword typed by the user
		$keyword = '%'.$keyword.'%';
		
		// search related keywords from the database
		if ($keyword!='') {
			$accounts = DB::table('users')
					->where('name', 'LIKE', $keyword)
					->orWhere('email', 'LIKE', $keyword)
					->orWhere('type', 'LIKE', $keyword)
					->get();
			$num_acc = count($accounts)+1;
			return view('manage_acc', ['accounts' => $accounts, 'num_acc' => $num_acc]); // view of managing account (**approvers/hr/admin only)
        }
    }
	
	// when deleting a user from DB
	public function del_user($id = null){
		DB::table('users')
			->where('id', $id)
			->delete();
		Session::flash('manage_acc_msg', 'The user has been deleted!');
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
			$user->type = $input['emp_type'];
			$user->team = $input['emp_team'];
			$user->save();
			
			Session::flash('manage_acc_msg', 'The new user has been added!');
			
			// if assigned as OIC, return to oic_time view
			if($input['emp_type'] == "officer in charge"){
				$emp_id = $user->id;
				return view('oic_time', ['emp_id' => $emp_id]);
			}
			return Redirect::to('/acc');
		}
		else{
			Session::flash('add_emp_msg', 'Duplicate Email! The email entered is already in the database');
			return Redirect::to('/add_emp');
		}
	}
	
	// get user to be edited from DB
	public function change_info_view($id = null){
		$chosen_user = DB::table('users')->where('id', $id)->first();
		return view('edit_info', ['chosen_user' => $chosen_user]);
	}
	
	// edit user's (employee) info and update in DB
	public function edit_employee(Request $request){
		$input = $request->all();
		// check if account exists before editing email of employee:
		if($this->check_duplicate_eadd($input['new_email'], $input['emp_id']) == null){
			// update info in DB
			$chosen_user = DB::table('users')
							->where('id', $input['emp_id'])
							->update([ 'name' => $input['new_name'] , 'email' => $input['new_email'] , 'type' => $input['new_type'] , 'team' => $input['new_team'] ]);
			
			Session::flash('manage_acc_msg', "The user's info has been edited!");
			
			// if assigned as OIC, return to oic_time view
			if($input['new_type'] == "officer in charge"){
				$emp_id = $input['emp_id'];
				return view('oic_time', ['emp_id' => $emp_id]);
			}
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
	
}
