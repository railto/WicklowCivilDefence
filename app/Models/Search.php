<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by', 'location', 'start', 'type',
        'officer_in_charge', 'search_manager', 'safety_officer',
        'section_leader', 'radio_operator', 'scribe',
    ];
}
