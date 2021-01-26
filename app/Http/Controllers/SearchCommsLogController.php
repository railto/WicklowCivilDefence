<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSearchCommsLogRequest;
use App\Models\Search;
use App\Models\SearchCommsLog;
use Illuminate\Http\JsonResponse;

class SearchCommsLogController extends Controller
{
    /**
     * @param Search $search
     * @param StoreSearchCommsLogRequest $request
     * @return JsonResponse
     */
    public function store(Search $search, StoreSearchCommsLogRequest $request): JsonResponse
    {
        $this->authorize('create', SearchCommsLog::class);

        $log = $search->commsLogs()->create([
            'created_by' => auth()->user()->id,
            'time' => $request->get('time'),
            'call_sign' => $request->get('call_sign'),
            'message' => $request->get('message'),
            'action' => $request->get('action'),
        ]);

        return response()->json(['id' => $log->id], 201);
    }
}
