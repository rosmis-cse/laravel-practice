<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\UserRoleRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Response as InertiaResponse;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function showAdmin(): InertiaResponse
    {
        return Inertia::render('Admin', [
            'user' => Auth::user()
        ]);
    }

    public function showRoles(): InertiaResponse
    {
        return Inertia::render('Roles', [
            'user' => Auth::user(),
            'roles' => UserRole::Admin,
            'users' => User::with('roles')->get()
        ]);
    }

    public function showCreateEstate(): InertiaResponse
    {
        return Inertia::render('EstateCreate', [
            'user' => Auth::user()
        ]);
    }

    public function saveUserRole(UserRoleRequest $request, int $id)
    {

        $roles = $request->validated();

        $user = User::findOrFail($id);

        //TODO finish this shit
        foreach($roles as $role) {
            if(!$user->roles()->where('role', $role)->first()) {
                $user->roles()->create([
                    'role' => $role
                ]);
            }

            
        }
        dd($user->roles()->where('role', UserRole::User)->first());
    }
}
