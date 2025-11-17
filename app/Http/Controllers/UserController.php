<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // dd(User::class);
        $this->authorize('viewAny', User::class);
        $users = User::all();
        return view('admin.user.list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create');

        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.user.add', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $profileImage = $request->file('profile_image');
        $profileImageName = time() . '.' . $profileImage->getClientOriginalExtension();
        $profileImage->move(public_path('storage/profile_images'), $profileImageName);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'profile_image' => $profileImageName,
        ]);

        return redirect()->route('add-user')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = \App\Models\Role::all();
        return view('admin.user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = User::findOrFail($request->id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'sometimes',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'roles' => 'required|array',
        ]);

        if ($request->hasFile('profile_image')) {
            $profileImage = $request->file('profile_image');
            $profileImageName = time() . '.' . $profileImage->getClientOriginalExtension();
            $profileImage->move(public_path('storage/profile_images'), $profileImageName);
            $user->profile_image = $profileImageName;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->status = $request->status;

        // Only update password if provided
        if (!empty($request->password)) {
            $user->password = bcrypt($request->password);
        }

        // Update only the fields we want to change
        $user->save();

        // dd($request->roles)


        // Sync roles
        $user->roles()->sync($request->roles);

        return redirect()->route('admin-user')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully');
    }

    public function toggleStatus(string $id)
    {
        $user = User::findOrFail($id);
        $user->status = $user->status == 1 ? 0 : 1;
        $user->save();
        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully',
            'is_active' => $user->stat
        ]);
    }

    public function changePassword(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.change-password', compact('user'));
    }
}
