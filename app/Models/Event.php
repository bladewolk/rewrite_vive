<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    const STATUS_CANCELED = 'canceled';

    protected $fillable = [
        'device_id',
        'username',
        'duration',
        'total_price',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}