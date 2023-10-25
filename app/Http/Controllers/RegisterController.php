<?php
 
namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class RegisterController extends Controller
{

    /**
     * Login page
     */
    public function index(): InertiaResponse
    {
        return Inertia::render('Register');
    }

    /**
     * Handle a registration attempt.
     */
    public function register(RegisterRequest $request): Response
    {
        $data = $request->validated();

        dd('HEREEE');

        $user = User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        Auth::login($user);

        $user->save();

        return response('user cree avec succés');
    }
}