<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSearchTeamRequest;
use App\Models\Search;
use App\Models\SearchTeam;
use Illuminate\Http\JsonResponse;

class SearchTeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(SearchTeam::class);
    }

    /**
     * @param StoreSearchTeamRequest $request
     * @param Search $search
     * @return JsonResponse
     */
    public function store(StoreSearchTeamRequest $request, Search $search): JsonResponse
    {
        $team = $search->teams()->create([
            'created_by' => auth()->user()->id,
            'name' => $request->get('name'),
            'leader' => $request->get('leader'),
            'medic' => $request->get('medic'),
            'responder_1' => $request->get('responder_1'),
            'responder_2' => $request->get('responder_2'),
            'responder_3' => $request->get('responder_3',)
        ]);

        return response()->json(['id' => $team->id], 201);
    }
}
