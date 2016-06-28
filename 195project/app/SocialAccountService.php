<?php

namespace App;

use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
        $account = User::whereEmail($providerUser->getEmail())
            ->first();			
        if ($account) {
            return $account;
        }
		else {			
			if(isset($providerUser->user['domain'])){
				if ($providerUser->user['domain'] == 'up.edu.ph'){
					$user = new User();
					$user->name = $providerUser->getName();
					$user->email = $providerUser->getEmail();
					$user->save();
					return $user;
				}
			return null;
			}
        }

    }
}