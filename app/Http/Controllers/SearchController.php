<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreSearchRequest;
use App\Http\Resources\SearchResource;
use App\Http\Resources\SearchResourceCollection;
use App\Models\Search;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class SearchController extends Controller
{
    /**
     * SearchController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Returns all searches
     *
     * @return SearchResourceCollection
     * @throws AuthorizationException
     */
    public function list(): SearchResourceCollection
    {
        $this->authorize('viewAny', Search::class);

        $searches = Search::all();

        return new SearchResourceCollection($searches);
    }

    /**
     * Returns individual search
     *
     * @param Search $search
     * @return SearchResource
     * @throws AuthorizationException
     */
    public function view(Search $search): SearchResource
    {
        $this->authorize('view', $search);

        return new SearchResource($search);
    }

    /**
     * Create new search record
     *
     * @param StoreSearchRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(StoreSearchRequest $request): JsonResponse
    {
        $this->authorize('create', Search::class);

        $search = Search::create([
            'created_by' => auth()->user()->id,
            'location' => $request->get('location'),
            'start' => $request->get('start'),
            'type' => $request->get('type'),
            'officer_in_charge' => $request->get('officer_in_charge'),
            'search_manager' => $request->get('search_manager'),
            'safety_officer' => $request->get('safety_officer'),
            'section_leader' => $request->get('section_leader'),
            'radio_operator' => $request->get('radio_operator'),
            'scribe' => $request->get('scribe'),
        ]);

        return response()->json(['data' => ['id' => $search->id]], 201);
    }
}
