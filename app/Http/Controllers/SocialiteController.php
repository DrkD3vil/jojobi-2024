<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SocialiteController extends Controller
{
    /**
     * Function: googlelogin
     * description: This function will redirect to the google login
     * @param NA
     * @return void
     */
    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleAuthentication()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
    
            if (empty($googleUser->id) || empty($googleUser->email)) {
                throw new Exception('Google user data is incomplete.');
            }
    
            $user = User::where('google_id', $googleUser->id)->first();
    
            if ($user) {
                Auth::login($user);
                return redirect()->route('dashboard');
            } else {
                $avatarPath = null;
                if (!empty($googleUser->avatar) && filter_var($googleUser->avatar, FILTER_VALIDATE_URL)) {
                    try {
                        $avatarContent = file_get_contents($googleUser->avatar);
    
                        $avatarDirectory = public_path('baackend_images/profile_images');
                        if (!File::exists($avatarDirectory)) {
                            File::makeDirectory($avatarDirectory, 0755, true);
                        }
    
                        $avatarFilename = uniqid() . '.jpg';
                        $avatarPath = 'baackend_images/profile_images/' . $avatarFilename;
                        file_put_contents($avatarDirectory . '/' . $avatarFilename, $avatarContent);
                    } catch (Exception $e) {
                        Log::warning('Avatar download failed: ' . $e->getMessage());
                    }
                }
    
                $newUser = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt(Str::random(16)),
                    'profile_image' => $avatarPath, // Save the full relative path
                ]);
    
                Auth::login($newUser);
                return redirect()->route('dashboard');
            }
        } catch (Exception $e) {
            Log::error('Google Authentication Error: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Unable to log in with Google. Please try again.');
        }
    }

}