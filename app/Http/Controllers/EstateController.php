<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;

use App\Http\Requests\EstateRequest;
use App\Models\Estate;
use App\Models\Option;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class EstateController extends Controller
{
    public function index(): InertiaResponse
    {
        $estates = Estate::all();

        return Inertia::render('Home', [
            'estates' => $estates,
            'user' => Auth::user()
        ]);
    }

    public function findOne(int $id, Request $request): InertiaResponse
    {
        $estate = Estate::findOrFail($id);

        $this->authorize('view', $estate);

        return Inertia::render('Estate', [
            'estate' => $estate,
            'user' => Auth::user()
        ]);
    }

    public function showOne(int $id, Request $request): InertiaResponse
    {
        $estate = Estate::findOrFail($id);

        return Inertia::render('EstateEdit', [
            'estate' => $estate,
            'user' => Auth::user()
        ]);
    }

    public function createEstate(EstateRequest $request): RedirectResponse
    {
        $estate = new Estate();

        $requestData = $request->only(['title', 'price', 'surface', 'rooms']);

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

        $estate->delete();

        return response('Le bien a été supprimé avec succés');
    }
}
