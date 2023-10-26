<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LoginController extends Controller
{

    /**
     * Login page
     */
    public function index(): InertiaResponse
    {
        return Inertia::render('Login');
    }



    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request): InertiaResponse|RedirectResponse
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
}