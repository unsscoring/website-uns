<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class OauthController extends Controller
{
    /**
     * Get Socialite driver with custom HTTP client for local environment
     */
    private function getSocialiteDriver()
    {
        $driver = Socialite::driver('google');
        
        // Disable SSL verification for local development only
        if (app()->environment('local')) {
            $driver->setHttpClient(new Client(['verify' => false]));
        }
        
        return $driver;
    }
    
    public function redirectToProvider()
    {
        return $this->getSocialiteDriver()->redirect();
    }
    public function handleProviderCallback()
    {
        try {

            $user = $this->getSocialiteDriver()->user();

            $finduser = User::where('gauth_id', $user->id)->first();

            if($finduser){

                Auth::login($finduser);
                return redirect('/dashboard');

            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'gauth_id'=> $user->id,
                    'gauth_type'=> 'google',
                    'password' => Hash::make(Str::random(32))
                ]);

                $newUser->assignRole('manajer');
                Auth::login($newUser);

                return redirect('/manajer/dashboard');
            }

        } catch (Exception $e) {
            // Log error untuk debugging
            \Log::error('Google OAuth Error: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect('/login')->withErrors([
                'oauth' => 'Gagal login dengan Google. Silakan coba lagi atau hubungi administrator.'
            ]);
        }
    }
}
