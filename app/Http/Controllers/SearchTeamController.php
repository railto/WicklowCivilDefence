<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSearchTeamRequest;
use App\Models\Search;
use App\Models\SearchTeam;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class SearchTeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * @param StoreSearchTeamRequest $request
     * @param Search $search
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(StoreSearchTeamRequest $request, Search $search): JsonResponse
    {
        $this->authorize('create', SearchTeam::class);

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

    /**
     * @param StoreSearchTeamRequest $request
     * @param Search $search
     * @param SearchTeam $team
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(StoreSearchTeamRequest $request, Search $search, SearchTeam $team): JsonResponse
    {
        $this->authorize('update', $team);

        $team->update($request->only('name', 'leader', 'medic', 'responder_1', 'responder_2', 'responder_3'));

        return response()->json();
    }
}
