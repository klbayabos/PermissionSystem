<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use Session;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class TypeController extends Controller
{
	
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
	
	public function del_type_view(){
		$type = DB::table('type')->select('name')->get();
		return view('del_type', ['type' => $type]);			// view of deleting a type
    }
	
	
	// delete team in DB
	public function del_type_DB(Request $request){
		DB::table('type')
			->where('name', $request->selected_type)
			->delete();
		Session::flash('manage_acc_msg', 'The type has been deleted!');
		return Redirect::to('/acc');
    }
}
