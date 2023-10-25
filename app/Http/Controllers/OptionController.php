<?php

namespace App\Http\Controllers;

use App\Models\Estate;
use App\Models\Option;
use Exception;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OptionController extends Controller
{
    public function index(): Response
    {
        $options = Option::all();

        return response($options);
    }

    public function findOne(int $id, Request $request)
    {
        $option = Estate::findOrFail($id);

        return response($option);
    }

    public function createOption(Request $request): Response
    {
        if(!$request->input('title')) throw new Exception('Option\'s title not provided');

        $option = new Option();

        $option->title = $request->input('title');

        $option->save();

        return response('L\'option a été ajouté avec succés');
    }

    public function updateOne(int $id, Request $request): Response
    {
        if(!$request->input('title')) throw new Exception('Option\'s title not provided');

        $option = Option::findOrFail($id);

        $option->title = $request->input('title');

        $option->save();

        return response('L\'option a été modifié avec succés');
    }

    public function removeOne(int $id): Response
    {
        $option = Option::findOrFail($id);

        $option->delete();

        return response('L\'option a été supprimé avec succés');
    }
}
