<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    // Display a list of users
    public function index()
    {
        if (!auth()->user()->can('view-users')) {
            return redirect()->back()->with('error', 'Permission denied');
        }
        try {
            $users = User::all();
            return view('users.index', compact('users'));
        } catch (\Exception $e) {
            Log::error('Error fetching users: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load users. Please try again.');
        }
    }

    // Show the form to create a new user
    public function create()
    {
        if (!auth()->user()->can('create-users')) {
            return redirect()->back()->with('error', 'Permission denied');
        }
        $roles=Role::all();
        // dd($roles);
        return view('users.create',[
            'roles'=>$roles,
        ]);
    }

    // Store a newly created user in the database
    public function store(Request $request)
    {
        $request->validate([
            'Fname' => 'required|string|max:255',
            'Lname' => 'required|string|max:255',
            'subdomain' => 'required|string|max:255|unique:users,subdomain',
            'email' => 'required|email|unique:users,email',
            'registration_countrycode' => 'required|string|max:10',
            'telephone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string',
        ]);

        try {
            User::create([
                'Fname' => $request->Fname,
                'Lname' => $request->Lname,
                'subdomain' => $request->subdomain,
                'email' => $request->email,
                'registration_countrycode' => $request->registration_countrycode,
                'telephone' => $request->telephone,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            return redirect()->route('users.index')->with('success', 'User created successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create user. Please try again.');
        }
    }

    // Display a specific user's details
    public function show(User $user)
    {
        // try {
        //     return view('users.show', compact('user'));
        // } catch (\Exception $e) {
        //     Log::error('Error showing user: ' . $e->getMessage());
        //     return redirect()->back()->with('error', 'Failed to load user details.');
        // }
    }

    // Show the form to edit an existing user
    public function edit($id)
    {
        if (!auth()->user()->can('edit-users')) {
            return redirect()->back()->with('error', 'Permission denied');
        }
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('users.edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    // Update an existing user in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'Fname' => 'required|string|max:255',
            'Lname' => 'required|string|max:255',
            'subdomain' => 'required|string|max:255|unique:users,subdomain,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'registration_countrycode' => 'required|string|max:10',
            'telephone' => 'required|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|string',
        ]);

        try {
            $user = User::findOrFail($id);
            $user->update([
                'Fname' => $request->Fname,
                'Lname' => $request->Lname,
                'subdomain' => $request->subdomain,
                'email' => $request->email,
                'registration_countrycode' => $request->registration_countrycode,
                'telephone' => $request->telephone,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
                'role' => $request->role,
            ]);

            return redirect()->route('users.index')->with('success', 'User updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update user. Please try again.');
        }
    }
    // Delete a user from the database
    public function destroy(User $user)
    {
        if (!auth()->user()->can('delete-users')) {
            return redirect()->back()->with('error', 'Permission denied');
        }
        try {
            $user->delete();
            return redirect()->route('users.index')->with('success', 'User deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete user. Please try again.');
        }
    }
}
