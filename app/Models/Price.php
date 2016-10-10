<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = [
        'device_id',
        'minTime',
        'price',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
