<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    const STATUS_CANCELED = 'canceled';
    const STATUS_ACTIVE = 'active';

    protected $fillable = [
        'device_id',
        'duration',
        'total_price',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function calculatePrice()
    {
        return $this->exists ?
            $this->total_price :
            round($this->device->price->value / 60 * $this->duration, 2);
    }
}