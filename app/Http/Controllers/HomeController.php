<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

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
        return view('pages.index', [
            'devices' => Device::all(),
            'events' => Event::latest()->paginate(4)
        ]);
    }

    public function ajaxPrice(Request $request)
    {
        $price = DB::table('prices')
            ->where('device_id', '=', $request->device_id)
            ->where('minTime', '<=', $request->duration)
            ->orderBy('created_at', 'desc')
            ->orderBy('minTime', 'desc')
            ->first();
        return ceil($price->value * $request->duration);
    }

    public function ajaxCancel(Event $event)
    {
        $event->update([
            'status' => Event::STATUS_CANCELED
        ]);
    }

}
