<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Device;
use App\Models\Event;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devices = Device::all();
        $events = Event::latest()
            ->paginate(4);

        return view('pages.index', [
            'devices' => $devices,
            'events' => $events
        ]);
    }

    public function ajaxPrice(Request $request, Device $device)
    {
        $price = $device->price
            ->where('minTime', '<=', $request->duration)
            ->first()->price;

        return round($price / 60 * $request->duration, 2);
    }

    public function ajaxCancel(Event $event)
    {
        $event->update([
            'status' => Event::STATUS_CANCELED
        ]);
    }

}
