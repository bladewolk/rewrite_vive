<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name'
    ];

    public function price()
    {
        return $this->hasOne(Price::class);
    }

    public function event()
    {
        return $this->hasMany(Event::class);
    }

}