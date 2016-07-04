<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Process;
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
					->select('team.name as team', 'request.*','users.id','users.name')
					->where('type', 'OT')
					->get();
		$obs = DB::select("SELECT * FROM (SELECT team_id, name AS team FROM team) AS der1 NATURAL JOIN (SELECT * FROM request WHERE type='OB') as der2 NATURAL JOIN ob_request_data");
		$count = count($obs);
		$ons = DB::select("SELECT * FROM (SELECT team_id, name AS team FROM team) AS der1 NATURAL JOIN (SELECT * FROM request WHERE type='ON') as der2");
		$count = count($ons);
		return view('approval_list', ['ots' => $ots, 'obs' => $obs, 'ons' => $ons]);
	}
}
