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

    public function records()
    {
        return $this->hasMany(Record::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class)->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setDurationAttribute($value)
    {
        $this->attributes['duration'] = $value;

        $prices = $this->device->prices
                ->where('minTime', '<=', $value)
                ->sortBy('minTime')
                ->get();
        
        $totalPrice = 0;
        foreach ($prices as $price) {
            $totalPrice += $price->value * ($value > $price->minTime ? $price->minTime : $value);
            $value -= $price->minTime;
        }
        
        $this->attributes['total_price'] = $totalPrice;
    }
}
