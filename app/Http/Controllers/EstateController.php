<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;

use App\Http\Requests\EstateRequest;
use App\Models\Estate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class EstateController extends Controller
{
    public function index(): InertiaResponse
    {
        $estates = Estate::all();

        return Inertia::render('Home', [
            'estates' => $estates,
            'currentUser' => Auth::user()
        ]);
    }

    public function view(int $id): InertiaResponse
    {
        $estate = Estate::findOrFail($id);

        $this->authorize('view', $estate);

        return Inertia::render('Estate', [
            'estate' => $estate,
            'currentUser' => Auth::user()
        ]);
        
    }

    public function showEdit(int $id): InertiaResponse
    {
        $estate = Estate::findOrFail($id);

        $policy = Gate::inspect('update', $estate);

        if(!$policy->allowed()) {
            return Inertia::render('Estate', [
                'estate' => $estate,
                'currentUser' => Auth::user(),
                'error' => 'Vous n\'etes pas autorisé à modifier un bien que vous n\'avez pas crée'
            ]);
        }

        return Inertia::render('EstateEdit', [
            'estate' => $estate,
            'currentUser' => Auth::user()
        ]);
    }

    public function create(EstateRequest $request): RedirectResponse
    {
        $estate = new Estate();

        $this->authorize('create', $estate);

        $requestData = $request->only(['title', 'price', 'surface', 'rooms', 'user_id']);

        foreach ($requestData as $key => $value) {
            $estate->{$key} = $value;
        }

        $estate->save();

        if($request->has('options')) {
            $estate->options()->sync($request->input('options'));
        }

        return to_route('estate', ['id' => $estate->id]);
    }

    public function updateOne(int $id, Request $request): RedirectResponse
    {
        $estate = Estate::findOrFail($id);

        $this->authorize('update', $estate);

        $requestData = $request->only(['title', 'price', 'surface', 'rooms']);

        foreach ($requestData as $key => $value) {
            $estate->{$key} = $value;
        }

        $estate->options()->sync($request->input('options'));

        $estate->save();

        return to_route('estate', ['id' => $estate->id]);
    }

    public function removeOne(int $id): Response
    {
        $estate = Estate::findOrFail($id);

        $this->authorize('delete', $estate);

        $estate->delete();

        return response('Le bien a été supprimé avec succés');
    }
}
