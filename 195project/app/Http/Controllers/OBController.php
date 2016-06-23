<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class OBController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
	// display view of obform 
	public function view_obform()
    {
		return view('obform'); 	// view the application for official business form & passing the variable
    }
	
	// when deleting your ob request
	public function del_ob()
    {
		return view('emp_ob');				// view your ob requests
    }
	
	// when submitting your ob request form
	public function get_OBrequest()
    {
		return view('emp_ob');				// view your ob requests
    }
}
