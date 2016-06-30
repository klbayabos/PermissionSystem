<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use Session;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class TypeController extends Controller
{
	
	public function __construct()
    {
        $this->middleware('auth');
    }
	
	// check duplicate type when adding new type
	public function check_duplicate_type($type){
		$temp = DB::table('type')
						->where('name', $type)
						->first();
		return $temp;
	}
	
	public function add_newtype_DB(Request $request){
		$type = $request->added_type;
		if(($this->check_duplicate_type($type)) == null){
			$newtype = new Type;	
			$newtype->name = $type;
			$newtype->save();
			Session::flash('manage_acc_msg', 'The new type has been added!');
			return Redirect::to('/acc');
		}
		else{
			Session::flash('add_type_msg', 'Error: Duplicate type!');
			return Redirect::to('/add_type');
		}
    }
}
