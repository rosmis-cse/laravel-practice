<?php

namespace App\Http\Controllers;

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

    public function showCreateEstate(): InertiaResponse
    {
        return Inertia::render('EstateCreate', [
            'user' => Auth::user()
        ]);
    }
}
