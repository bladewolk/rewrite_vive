<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    const STATUS_CANCELED = 'canceled';
    const STATUS_ACTIVE = 'active';

    protected $fillable = [
        'status',
        'device_id',
        'duration',
        'total_price',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class)->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function calculatePrice()
    {
        return $this->device->price
            ->where('minTime', '<=', $this->duration)
            ->orderBy('created_at', 'desc')
            ->orderBy('minTime', 'desc')
            ->first()
            ->value * $this->duration;
    }
}
