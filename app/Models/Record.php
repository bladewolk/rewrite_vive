<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = [
        'status',
        'user_id',
        'description',
        'event_id'
    ];
}
