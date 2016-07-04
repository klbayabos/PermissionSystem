<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Process;
use App\State;
use App\RequestApplication;
use App\OBRequestData;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class RequestController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	public function view_all()
	{
		$ots = DB::table('request')
					->leftJoin('users', 'request.id', '=', 'users.id')
					->leftJoin('team', 'users.team_id', '=', 'team.team_id')
					->leftJoin('state','state.state_id', '=', 'request.status')
					->leftJoin('state_type','state_type.state_type_id', '=', 'state.state_type_id')
					->select('team.name as team', 'request.*','users.id','users.name','state_type.name as state')
					->where('type', 'OT')
					->get();
		$obs = DB::table('request')
					->leftJoin('users', 'request.id', '=', 'users.id')
					->leftJoin('team', 'users.team_id', '=', 'team.team_id')
					->leftJoin('state','state.state_id', '=', 'request.status')
					->leftJoin('state_type','state_type.state_type_id', '=', 'state.state_type_id')
					->select('team.name as team', 'request.*','users.id','users.name','state_type.name as state')
					->where('type', 'OB')
					->get();
		$count = count($obs);
		$ons = DB::table('request')
					->leftJoin('users', 'request.id', '=', 'users.id')
					->leftJoin('team', 'users.team_id', '=', 'team.team_id')
					->leftJoin('state','state.state_id', '=', 'request.status')
					->leftJoin('state_type','state_type.state_type_id', '=', 'state.state_type_id')
					->select('team.name as team', 'request.*','users.id','users.name','state_type.name as state')
					->where('type', 'ON')
					->get();
		$count = count($ons);
		return view('approval_list', ['ots' => $ots, 'obs' => $obs, 'ons' => $ons]);
	}
}
