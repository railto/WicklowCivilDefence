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
        'created_by', 'location', 'start', 'type',
        'officer_in_charge', 'search_manager', 'safety_officer',
        'section_leader', 'radio_operator', 'scribe',
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
}
