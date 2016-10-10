<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    public function price()
    {
        return $this->hasOne(Price::class);
    }
}