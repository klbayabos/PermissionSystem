<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class OTController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
	// display view of otform
	public function view_otform()
    {
		return view('otform');				// view the application for overtime form & passing the variable
    }
	
	// when deleting your ot request
	public function del_ot()
    {
		return view('emp_ot');				// view your overtime requests
    }
}
