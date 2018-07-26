<?php

namespace ColoredCow\LaravelGSuite\Traits;

use Laravel\Socialite\Facades\Socialite;

trait CreatesLogin
{
    /**
     * Socialite method to handle incoming auth/provider requests.
     * Visit Socialite documentation for more details.
     *
     * @return Socialite
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Socialite method to handle provider callbacks.
     * Visit Socialite documentation for more details.
     *
     * @return Socialite
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->user();
        // $user->token
    }
}
