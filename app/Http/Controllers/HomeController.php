<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Devices;
use App\Prices;
use App\Events;
use App\Http\Requests\Event;

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
        $devices = Devices::all();
        $events = Events::latest()->Paginate(4);
        return view('pages.index', compact('devices', 'events'));
    }

    public function ajaxPrice(Request $request)
    {
        $price = DB::table('prices')
            ->where('device_id', '=', $request->radio)
            ->where('minTime', '<', $request->numb)
            ->orderBy('created_at', 'desc')
            ->orderBy('minTime', 'desc')
            ->first();
        $totalPrice = $price->price / $price->maxTime * $request->numb;
        return round($totalPrice, 2);
    }

    public function create(Event $request)
    {
        $price = DB::table('prices')
            ->where('device_id', '=', $request->device_id)
            ->where('minTime', '<', $request->duration)
            ->orderBy('created_at', 'desc')
            ->orderBy('minTime', 'desc')
            ->first();
        $totalPrice = round($price->price / $price->maxTime * $request->duration, 2);

        $event = new Events;
        $event->username = $request->username;
        $event->device_id = $request->device_id;
        $event->duration = $request->duration;
        $event->total_price = $totalPrice;
        $event->save();
        return redirect('/');
    }
}
