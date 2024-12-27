<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Facades\Log;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $permissions = Permission::all(); // Retrieve all permissions
            return view('role-permission.permission.index', compact('permissions'));
        } catch (\Exception $e) {
            Log::error('Error fetching permissions: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to fetch permissions.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('role-permission.permission.create');
        } catch (\Exception $e) {
            Log::error('Error showing create form: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load create form.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:permissions',
                'description' => 'nullable|string',
            ]);

            Permission::create([
                'name' => $request->name,
                'guard_name' => 'web',
                'description' => $request->description,
            ]);

            return redirect()->route('permissions.index')->with('success', 'Permission created successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating permission: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create permission.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $permission = Permission::findOrFail($id);
            return view('role-permission.permission.show', compact('permission'));
        } catch (\Exception $e) {
            Log::error('Error showing permission: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load permission details.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $permission = Permission::findOrFail($id);
            return view('role-permission.permission.edit', compact('permission'));
        } catch (\Exception $e) {
            Log::error('Error showing edit form: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load edit form.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:permissions,name,' . $id,
                'description' => 'nullable|string',
            ]);

            $permission = Permission::findOrFail($id);
            $permission->update([
                'name' => $request->name,
                'guard_name' => 'web',
                'description' => $request->description,
            ]);

            return redirect()->route('permissions.index')->with('success', 'Permission updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating permission: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update permission.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $permission = Permission::findOrFail($id);
            $permission->delete();

            return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error deleting permission: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete permission.');
        }
    }
}
