<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSearchRadioAssignmentRequest;
use App\Models\Search;
use App\Models\SearchRadioAssignment;
use Illuminate\Http\Request;

class SearchRadioAssignmentController extends Controller
{
    public function store(StoreSearchRadioAssignmentRequest $request, Search $search)
    {
        $this->authorize('create', SearchRadioAssignment::class);

        $assignment = $search->radios()->create([
            'created_by' => auth()->user()->id,
            'name' => $request->get('name'),
            'call_sign' => $request->get('call_sign'),
            'tetra_number' => $request->get('tetra_number'),
        ]);

        return response()->json(['id' => $assignment->id], 201);
    }
}
