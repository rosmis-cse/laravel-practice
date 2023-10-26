<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;

use App\Http\Requests\EstateRequest;
use App\Models\Estate;
use App\Models\Option;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

        return Inertia::render('Estate', [
            'estate' => $estate
        ]);
    }

    public function createEstate(EstateRequest $request): Response
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

        return response('Le bien a été ajouté avec succés');
    }

    public function updateOne(int $id, Request $request): Response
    {
        $estate = Estate::findOrFail($id);

        $requestData = $request->only(['title', 'price', 'surface', 'rooms']);

        foreach ($requestData as $key => $value) {
            $estate->{$key} = $value;
        }

        $estate->options()->sync($request->input('options'));

        $estate->save();

        return response('Le bien a été modifié avec succés');
    }

    public function removeOne(int $id): Response
    {
        $estate = Estate::findOrFail($id);

        $estate->delete();

        return response('Le bien a été supprimé avec succés');
    }
}
