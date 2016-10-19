<?php

namespace App\Providers;

use App\Models\Device;
use App\Models\Event;
use App\Models\Record;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Event::creating(function ($event) {
            $event->user_id = Auth::user()->id;
        });

        Event::updating(function ($event) {
            $record = new Record($event->getAttributes());
            $record->event_id = $event->id;
            $record->user_id = Auth::user()->id;
            $record->description = Input::get('description');
            $record->save();
        });

        Device::deleting(function ($device) {
            $device->prices()->delete();
        });

        Device::restored(function ($device) {
            $device->prices()->restore();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
