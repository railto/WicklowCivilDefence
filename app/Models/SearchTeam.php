<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SearchTeam extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'created_by', 'search_id', 'name', 'leader',
        'medic', 'responder_1', 'responder_2', 'responder_3',
    ];

    /**
     * @return BelongsTo
     */
    public function search(): BelongsTo
    {
        return $this->belongsTo(Search::class);
    }
}
