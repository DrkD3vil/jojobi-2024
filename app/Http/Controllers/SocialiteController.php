<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Storage;

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
            // Get the user data from Google API
            $googleUser = Socialite::driver('google')->user();

            // Check if the user exists in the database
            $user = User::where('google_id', $googleUser->id)->first();

            if ($user) {
                Auth::login($user);
                return redirect()->route('dashboard'); // Redirect to your desired route after successful login
            } else {
                $avatarContent = file_get_contents($googleUser->avatar);
                $avatarPath = 'profile_images/' . uniqid() . '.jpg';

                // Store the avatar in public storage
                Storage::put('public/' . $avatarPath, $avatarContent);

                // Create a new user if not found
                $newUser = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt('password'), // Use a default password or generate one securely
                    // 'profile_image' => $googleUser->avatar, // Store the avatar URL in the profile_images column
                    'profile_image' => basename($avatarPath)
                ]);

                Auth::login($newUser);
                return redirect()->route('dashboard'); // Redirect to your desired route after successful login
            }
        } catch (Exception $e) {
            Log::error('Google Authentication Error: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Unable to log in with Google. Please try again.');
        }
    }
}
