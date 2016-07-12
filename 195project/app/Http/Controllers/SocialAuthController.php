<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SocialAccountService;
use Socialite;
use Illuminate\Support\Facades\Redirect;

use Session;
class SocialAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();   
    }   

    public function callback(SocialAccountService $service)
    {
			$user = $service->createOrGetUser(Socialite::driver('google')->user());
			if($user != null){
				auth()->login($user);
				if(\Auth::user()->type_id == 1 || \Auth::user()->type_id == 4){ // if Head/supervisor
					return Redirect::to('/aplist');		// view approval list
				}
				else{ // if employee/hr/team leader/admin/approver
					return Redirect::to('/officialbusiness');		// view ob req
				}
			}
			else{
				Session::flash('error_signin', 'Account is not yet in the database!');
				return view('auth\login');								// view of loginpage
			}
    }	
}