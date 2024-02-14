<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\User;
use Socialite;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.sessions.login');
    }

    public function postLogin(Requests\LoginRequest $request)
    {
        if (User::login($request)) {
            $user = Auth::user();
            $status = $user->status;
            if ($status == 1) {
                flash()->success('Welcome to Purple Smart TV');
                return redirect()->to('/dashboard');
            } else {
                Auth::logout();
                flash()->error('Account Inactive');
                return redirect()->back();
            }
        }
        flash()->error('Invalid Login Credentials');
        return redirect()->back();
    }

    public function logOut()
    {
        Auth::logout();

        return redirect()->to('/login');
    }

    public function register()
    {
        return view('admin.sessions.register');
    }

    /**
     * Redirect the user to the authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $provider_user = Socialite::driver($provider)->user();
        $user = $this->findUserByProviderOrCreate($provider, $provider_user);
        auth()->login($user);
        flash()->success('Welcome to Purple Smart TV');

        return redirect()->to('/admin');
    }

    private function findUserByProviderOrCreate($provider, $provider_user)
    {
        $user = User::where($provider . '_id', $provider_user->token)
            ->orWhere('email', $provider_user->email)
            ->first();
        if (!$user) {
            $user = User::create([
                'name' => $provider_user->name,
                'email' => $provider_user->email,
                $provider . '_id' => $provider_user->token
            ]);
        } else {
            // Update the token on each login request
            $user[$provider . '_id'] = $provider_user->token;
            $user->save();
        }

        return $user;
    }
}
