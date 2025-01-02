<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
 * Handle an incoming registration request.
 *
 * @throws \Illuminate\Validation\ValidationException
 */
public function store(Request $request): RedirectResponse
{
    $validatedData = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'phone' => ['required', 'string', 'regex:/^(01\d{9})$/'], // Ensure the user inputs 11 digits starting with '01'
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    // Process the phone number to ensure the format is 880 followed by the number without extra 0s
    $processedPhone = '880' . ltrim($validatedData['phone'], '0');

    $user = User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'phone' => $processedPhone,
        'password' => Hash::make($validatedData['password']),
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect()->route('dashboard');
}
}
