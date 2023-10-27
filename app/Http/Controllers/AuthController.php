<?php

namespace App\Http\Controllers;

use App\Enums\UserRole as EnumsUserRole;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use App\Services\AuthService;
use App\Services\Dto\RegisterDto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    )
    {}

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
    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();
 
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
        $registerDto = new RegisterDto(
            name: $request['name'],
            email: $request['email'],
            password: bcrypt($request['password']),
        );

        $this->authService->register($registerDto);

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
