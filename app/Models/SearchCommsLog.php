<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchCommsLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by', 'time', 'call_sign', 'message', 'action'
    ];
}
