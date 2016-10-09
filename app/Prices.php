<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prices extends Model
{
    protected $fillable = [
        'device_id', 'minTime', 'maxTime', 'price',
    ];
}
