<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSearchCommsLogRequest;
use App\Http\Resources\SearchCommsLogResource;
use App\Models\Search;
use App\Models\SearchCommsLog;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class CommsLogController extends Controller
{
    /**
     * @param Search $search
     * @param StoreSearchCommsLogRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(Search $search, StoreSearchCommsLogRequest $request): JsonResponse
    {
        $this->authorize('create', [SearchCommsLog::class, $search]);

        $log = $search->commsLogs()->create([
            'created_by' => auth()->user()->id,
            'time' => $request->get('time'),
            'call_sign' => $request->get('call_sign'),
            'message' => $request->get('message'),
            'action' => $request->get('action'),
        ]);

        return (new SearchCommsLogResource($log))->response()->setStatusCode(201);
    }
}
