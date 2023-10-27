<?php

namespace App\Http\Controllers;

use App\Enums\UserRole as EnumsUserRole;
use App\Http\Requests\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class AuthController extends Controller
{
    /**
     * Register page
     */
    public function showRegister(): InertiaResponse
    {
        return Inertia::render('Register');
    }

    /**
     * Login page
     */
    public function showLogin(): InertiaResponse
    {
        return Inertia::render('Login');
    }

    /**
     * Handle an authentication attempt.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->route('home');
        } else {
            return redirect()->back()->withErrors('Identifiants incorrects ou erronés');
        } 
    }

    /**
     * Handle a registration attempt.
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        // assign default role to newly created user to "user" role
        $user->roles()->create([
            "role" => EnumsUserRole::User
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('home');
    }

    public function getAssociatedRolesUser(int $id)
    {
        $user = User::findOrFail($id);

        return $user->roles;
    }
}
