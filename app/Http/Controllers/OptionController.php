<?php

namespace App\Http\Controllers;

use App\Http\Requests\OptionRequest;
use App\Http\Resources\OptionRessource;
use App\Models\Estate;
use App\Models\Option;
use Exception;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OptionController extends Controller
{
    public function index(): JsonResponse
    {
        $options = Option::all();

        return OptionRessource::collection($options)->response();
    }

    public function findOne(int $id, Request $request): JsonResponse
    {
        $option = Estate::findOrFail($id);

        return OptionRessource::make($option)->response();
    }

    public function createOption(OptionRequest $request): JsonResponse
    {
        $option = new Option();

        $option->title = (string)$request->string('title');

        $option->save();

        return OptionRessource::make($option)->response()->setStatusCode(JsonResponse::HTTP_CREATED);
    }

    public function updateOne(int $id, OptionRequest $request): JsonResponse
    {
        $option = Option::findOrFail($id);

        $option->title = (string)$request->string('title');

        $option->save();

        return OptionRessource::make($option)->response();
    }

    public function removeOne(int $id): JsonResponse
    {
        $option = Option::findOrFail($id);

        $option->delete();

        return new JsonResponse(status: JsonResponse::HTTP_NO_CONTENT);
    }
}
