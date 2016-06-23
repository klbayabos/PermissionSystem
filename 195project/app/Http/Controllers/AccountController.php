<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
					->where('name', '!=', \Auth::user()->name)
					->where('email', '!=', \Auth::user()->email)
					->where('type', '!=', 'admin')
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
	
	// get user to be edited from DB
	public function changetype($id = null){
		$chosen_user = DB::table('users')->where('id', $id)->first();
		return view('change_usertype', ['chosen_user' => $chosen_user]);
	}
	
	
	// when changing usertype: get the "new type" then change type from DB
	public function changetype_inDB(Request $request){
		$input = $request->all();
		$chosen_user = DB::table('users')
						->where('id', $input['emp_id'])
						->update([ 'type' => $input['new_type'] ]);
						
		Session::flash('success_edittype', 'User type has been edited!');
		return Redirect::to('/acc');
	}
	
}
