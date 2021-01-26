<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSearchRadioAssignmentRequest;
use App\Http\Resources\SearchRadioAssignmentResource;
use App\Models\Search;
use App\Models\SearchRadioAssignment;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class RadioAssignmentController extends Controller
{
    /**
     * @param StoreSearchRadioAssignmentRequest $request
     * @param Search $search
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(StoreSearchRadioAssignmentRequest $request, Search $search): JsonResponse
    {
        $this->authorize('create', SearchRadioAssignment::class);

        $assignment = $search->radios()->create([
            'created_by' => auth()->user()->id,
            'name' => $request->get('name'),
            'call_sign' => $request->get('call_sign'),
            'tetra_number' => $request->get('tetra_number'),
        ]);

        return (new SearchRadioAssignmentResource($assignment))->response()->setStatusCode(201);
    }
}
