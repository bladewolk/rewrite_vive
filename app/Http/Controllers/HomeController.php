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
        redirect('/');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devices = Devices::all();
        $events = Events::latest()
            ->join('devices', 'events.device_id', '=', 'devices.device_id')
            ->select('events.*', 'devices.name')
            ->Paginate(4);
        return view('pages.index', compact('devices', 'events'));
    }

    public function ajaxPrice(Request $request)
    {
        $price = DB::table('prices')
            ->where('device_id', '=', $request->radio)
            ->where('minTime', '<=', $request->numb)
            ->orderBy('minTime', 'desc')
            ->first();
        $totalPrice = $price->price / 60 * $request->numb;
        return round($totalPrice, 2);
    }

    public function ajaxCancel(Request $request)
    {
        Events::where('id', $request->event_id)
            ->update(['status' => $request->status]);
        return $request;
    }

    public function create(Event $request)
    {

    }
}
