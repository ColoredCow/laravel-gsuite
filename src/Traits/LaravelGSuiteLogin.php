<?php

namespace ColoredCow\LaravelGSuite\Traits;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

trait LaravelGSuiteLogin
{
    protected $redirectTo = '/home';

    /**
     * Socialite method to handle incoming auth requests.
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
        $socialiteUser = Socialite::driver('google')->user();
        $user = $this->findOrCreateUser($socialiteUser, 'google');
        Auth::login($user, true);
        return $this->afterHandleProvider();
    }

    /**
     * Defines actions to perform after handleProviderCallback is executed.
     *
     * @return \Illuminate\Http\Response\Redirect;
     */
    public function afterHandleProvider()
    {
        return redirect($this->redirectTo);
    }

    /**
     * If a user has registered before using social auth, return the user
     * otherwise, create a new user.
     *
     * @param  $user Socialite
     * @param  $provider Social auth provider
     * @return User
     */
    public function findOrCreateUser($socialiteUser, $provider)
    {
        $userModel = config('auth.providers.users.model');

        $user = $userModel::where('provider_id', $socialiteUser->id)->first();
        if ($user) {
            return $user;
        }
        return $userModel::create([
            'name' => $socialiteUser->name,
            'email' => $socialiteUser->email,
            'provider' => $provider,
            'provider_id' => $socialiteUser->id,
            'avatar' => $socialiteUser->avatar_original,
        ]);
    }
}
