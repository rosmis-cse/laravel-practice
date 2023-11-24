<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\UserRoleRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Response as InertiaResponse;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function showAdmin(): InertiaResponse
    {
        return Inertia::render('Admin', [
            'currentUser' => Auth::user()
        ]);
    }

    public function showRoles(): InertiaResponse
    {
        return Inertia::render('Roles', [
            'users' => User::with('roles')->get(),
            'currentUser' => Auth::user()
        ]);
    }

    public function showCreateEstate(): InertiaResponse
    {
        return Inertia::render('EstateCreate', [
            'user' => Auth::user()
        ]);
    }

    public function saveUserRole(UserRoleRequest $request, int $id): RedirectResponse
    {
        $roles = $request->validated()['roles'];

        $user = User::findOrFail($id);
        $isUserAdmin = $user->hasRole(UserRole::Admin);

        if(in_array('admin', $roles) && !$isUserAdmin) {
            $user->roles()->create(['role' => UserRole::Admin]);
        } else if ($isUserAdmin) {
            $user->roles()->where('role', UserRole::Admin)->delete();
        }

        return to_route('admin');
    }
}
