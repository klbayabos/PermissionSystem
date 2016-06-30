<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use Session;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class TeamController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
	// check duplicate team when adding new team
	public function check_duplicate_team($team){
		$temp = DB::table('team')
						->where('name', $team)
						->first();
		return $temp;
	}
	
	public function add_newteam_DB(Request $request){
		$team = $request->added_team;
		if(($this->check_duplicate_team($team)) == null){
			$newteam = new Team;	
			$newteam->name = $team;
			$newteam->save();
			Session::flash('manage_acc_msg', 'The new team has been added!');
			return Redirect::to('/acc');
		}
		else{
			Session::flash('add_team_msg', 'Error: Duplicate team!');
			return Redirect::to('/add_team');
		}
    }
}
