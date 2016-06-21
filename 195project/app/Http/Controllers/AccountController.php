<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
class AccountController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
	// display view of managing account
	public function view_acc()
    {
		// get all users except current user
		$accounts = DB::table('users')
					->where('name', '!=', \Auth::user()->name)
					->where('email', '!=', \Auth::user()->email)
					->get();
		return view('manage_acc', ['accounts' => $accounts]);	// view of managing account (**approvers/hr/admin only)
    }
}
