<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of all users.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $users = User::all(); // Fetch all users from the database
        return view('adminBackend.users.index', compact('users','user'));
    }

    /**
     * Show the details of a specific user.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $user = Auth::user();
        $userdata = User::findOrFail($id); // Fetch the user by ID, or fail if not found
        return view('adminBackend.users.show', compact('user', 'userdata'));
    }

    /**
     * Show the form for editing a specific user.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = Auth::user();
        $userdata = User::findOrFail($id); // Fetch the user by ID, or fail if not found
        return view('adminBackend.users.edit', compact('user','userdata'));
    }

    /**
     * Update the specified user in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validate incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id, // Ensure email is unique except for the current user
            'phone' => 'nullable|string|max:20',
            'role' => 'required|string|in:admin,user,moderator,guest', // Restrict roles to 'admin' or 'user'
            'status' => 'required|string|in:active,inactive,suspended,blocked,unverified,verified',
        ]);

        // Fetch the user by ID
        $user = User::findOrFail($id);

        // Update user details
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            'status' => $request->status,
        ]);

        // Redirect back with a success message
        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }
}
