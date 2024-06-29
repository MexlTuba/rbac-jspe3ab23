<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserInfo;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function manageUsers()
    {
        $users = User::select('id', 'name', 'email')->get();
        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.manageUsers')->with(compact('users', 'roles', 'permissions'));
    }

    public function assignRole(Request $request)
    {
        foreach ($request->roles as $userId => $roles) {
            $user = User::find($userId);
            if ($user) {
                $user->roles()->sync($roles);
            }
        }

        return redirect()->route('usertool')->with('success', 'Roles updated successfully.');
    }

    public function assignPermission(Request $request)
    {
        foreach ($request->permissions as $roleId => $permissions) {
            $role = Role::find($roleId);
            if ($role) {
                $role->permissions()->sync($permissions);
            }
        }

        return redirect()->route('usertool')->with('success', 'Permissions updated successfully.');
    }
}
