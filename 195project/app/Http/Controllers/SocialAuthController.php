<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SocialAccountService;
use Socialite;

class SocialAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();   
    }   

    public function callback(SocialAccountService $service)
    {
		$user = $service->createOrGetUser(Socialite::driver('google')->user());

        auth()->login($user);
		//dd(Socialite::driver('google')->user());
		return redirect()->to('/overtime');						// view overtime request
		
    }
}