<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Search extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'created_by', 'location', 'start', 'end', 'type',
        'officer_in_charge', 'search_manager', 'safety_officer',
        'section_leader', 'radio_operator', 'scribe', 'notes',
    ];

    /**
     * @return HasMany
     */
    public function teams(): HasMany
    {
        return $this->hasMany(SearchTeam::class);
    }

    public function radios(): HasMany
    {
        return $this->hasMany(SearchRadioAssignment::class);
    }

    public function commsLogs(): HasMany
    {
        return $this->hasMany(SearchCommsLog::class);
    }

    public function searchLogs(): HasMany
    {
        return $this->hasMany(SearchLog::class);
    }
}
