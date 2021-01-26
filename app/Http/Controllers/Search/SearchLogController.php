<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSearchLogRequest;
use App\Http\Resources\SearchLogResource;
use App\Models\Search;
use App\Models\SearchLog;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class SearchLogController extends Controller
{
    /**
     * @param Search $search
     * @param StoreSearchLogRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(Search $search, StoreSearchLogRequest $request): JsonResponse
    {
        $this->authorize('create', SearchLog::class);

        $log = $search->searchLogs()->create([
            'created_by' => auth()->user()->id,
            'team' => $request->get('team'),
            'area' => $request->get('area'),
            'start_time' => $request->get('start_time'),
            'end_time' => $request->get('end_time'),
            'notes' => $request->get('notes'),
        ]);

        return (new SearchLogResource($log))->response()->setStatusCode(201);
    }

    /**
     * @param Search $search
     * @param SearchLog $log
     * @param StoreSearchLogRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(Search $search, SearchLog $log, StoreSearchLogRequest $request): JsonResponse
    {
        $this->authorize('update', $log);

        $log->update($request->only(['team', 'area', 'start_time', 'end_time', 'notes']));

        return (new SearchLogResource($log))->response()->setStatusCode(200);
    }
}
