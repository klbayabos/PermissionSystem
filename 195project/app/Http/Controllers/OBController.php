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
}
