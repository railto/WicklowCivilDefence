<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SearchRadioAssignment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'created_by', 'search_id', 'name', 'call_sign', 'tetra_number',
    ];

    /**
     * @return BelongsTo
     */
    public function search(): BelongsTo
    {
        return $this->belongsTo(Search::class);
    }
}
