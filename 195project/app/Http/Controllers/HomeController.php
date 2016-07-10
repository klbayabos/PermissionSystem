<?php

namespace App\Http\Controllers;
use Mail;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
	
    public function send_email(){
		try{
			$sent = Mail::raw('HI!!! OMG NAKAKAPAGSEND NA NG EMAIL :))))', function ($message) {
				$message->from('kathleen.klb@gmail.com', 'Kathleen');
				$message->to('kathleen.klb@gmail.com');
				$message->subject('LARAVEL EMAIL');
			});
		}
		catch (\Exception $e){
			dd($e->getMessage());
		}
		Session::flash('manage_acc_msg', 'Email Sent :)');
		return Redirect::to('/acc');
    }
	
}
